<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForMonthController extends Controller
{
    public function getByMonth(Request $request): JsonResponse
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $userId = Auth::id();

        $daysWithTasks = Task::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->whereYear('deadline', $year)
            ->whereMonth('deadline', $month)
            ->orderBy('deadline')
            ->pluck('deadline')
            ->map(function ($date) {
                return Carbon::parse($date)->toDateString();
            })
            ->unique()
            ->values()
            ->toArray();

        // Создаем массив дней месяца с пометкой о наличии или отсутствии задач
        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $allDaysOfMonth = [];
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $allDaysOfMonth[] = [
                'date' => $date->toDateString(),
                'has_tasks' => in_array($date->toDateString(), $daysWithTasks),
            ];
        }

        return response()->json(['days' => $allDaysOfMonth]);
    }

}

<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use App\Models\UserTask;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForMonthController extends Controller
{
    public function getByMonth(Request $request) : JsonResponse
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $tasks = Task::whereYear('deadline', $year)
            ->whereMonth('deadline', $month)
            ->with('subTasks')
            ->orderBy('deadline')
            ->get()
            ->map(function ($task) {
                $task->date = Carbon::parse($task->deadline)->toDateString();
                return $task;
            });


        return response()->json([
            'tasks' => $tasks,
        ]);

    }

}

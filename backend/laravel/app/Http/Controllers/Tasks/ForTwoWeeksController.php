<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\UserTask;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForTwoWeeksController extends Controller
{
    public function getTwoWeeks(): JsonResponse
    {
        $user = Auth::user();
        $currentDate = Carbon::today();
        $twoWeeksLater = $currentDate->copy()->addWeeks(2);

        $tasks = $this->getUserTasks($user->id, $currentDate, $twoWeeksLater);

        $tasksByDate = $this->groupTasksByDate($tasks);

        return response()->json([
            'tasks' => $tasksByDate,
        ]);
    }

    private function getUserTasks($userId, $startDate, $endDate)
    {
        return UserTask::where('user_id', $userId)
            ->whereHas('task', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('deadline', [$startDate, $endDate]);
            })
            ->with(['task.subTasks'])
            ->get()
            ->sortBy(function ($userTask) {
                return $userTask->task->deadline;
            });
    }

    private function groupTasksByDate($tasks)
    {
        return $tasks->groupBy(function ($userTask) {
            return Carbon::parse($userTask->task->deadline)->toDateString();
        })->map(function ($tasks, $date) {
            return [
                'date' => $date,
                'tasks' => TaskResource::collection($tasks->pluck('task')),
            ];
        })->values()->all();
    }
}

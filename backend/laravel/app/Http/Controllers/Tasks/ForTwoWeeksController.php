<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Resources\TaskResource;
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
        $twoWeeksLater = $currentDate->copy()->addDays(13);

        $tasks = $this->getUserTasks($user->id, $currentDate, $twoWeeksLater);

        $tasksByDate = $this->groupTasksByDate($tasks, $currentDate, $twoWeeksLater);

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

    private function groupTasksByDate($tasks, $startDate, $endDate)
    {
        $dates = collect();
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dates->put($date->toDateString(), [
                'date' => $date->toDateString(),
                'tasks' => []
            ]);
        }

        $tasksByDate = $tasks->groupBy(function ($userTask) {
            return Carbon::parse($userTask->task->deadline)->toDateString();
        });

        $tasksByDate->each(function ($tasks, $date) use ($dates) {
            $dates->transform(function ($item) use ($tasks, $date) {
                if ($item['date'] == $date) {
                    $item['tasks'] = TaskResource::collection($tasks->pluck('task'));
                }
                return $item;
            });
        });

        return $dates->values()->all();
    }
}

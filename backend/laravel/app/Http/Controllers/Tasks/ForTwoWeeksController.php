<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use App\Models\UserTask;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ForTwoWeeksController extends Controller
{
    public function getTwoWeeks() : JsonResponse
    {
        $user = auth()->user();
        $currentDate = Carbon::today();
        $twoWeeksLater = $currentDate->copy()->addWeeks(2);

        $tasks = UserTask::where('user_id', $user->id)
            ->whereHas('task', function($query) use ($currentDate, $twoWeeksLater) {
                $query->whereBetween('deadline', [$currentDate, $twoWeeksLater]);
            })
            ->with(['task' => function($query) {
        $query->with('subTasks');
    }, 'status'])
            ->get()
            ->sortBy(function($task) {
                return $task->task->deadline;
            });

        return response()->json([
            'task' => $tasks,
        ]);
    }

}

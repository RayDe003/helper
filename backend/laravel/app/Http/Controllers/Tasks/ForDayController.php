<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\UserTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForDayController extends Controller
{
    public function getByDate(Request $request): JsonResponse
    {
        $user = Auth::user();
        $date = $request->input('date', Carbon::today()->toDateString());

        $tasks = Task::whereDate('deadline', $date)
            ->with('subTasks')
            ->get();

        $tasksWithStatuses = $tasks->map(function ($task) use ($user) {
            $userTask = UserTask::where('user_id', $user->id)
                ->where('task_id', $task->id)
                ->first();

            return new TaskResource($task);
        });

        return response()->json([
            'tasks' => $tasksWithStatuses,
        ]);
    }

}
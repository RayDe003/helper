<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class GetOneTaskController extends Controller
{

    public function getTask(Task $task): JsonResponse
    {
        $this->authorize('view', $task);
//        UserTask::where('user_id', $user->id)
//            ->where('task_id', $task->id)
//            ->first();

        $taskWithSubTasks = new TaskResource($task->load('subTasks'));

        return response()->json([
            'task' => $taskWithSubTasks,
        ]);
    }

}

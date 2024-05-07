<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateTaskController extends Controller
{

    public function updateTask(Request $request, Task $task) : JsonResponse
    {
        if (!$task->users->contains(auth()->user()->id)) {
            return response()->json([
                'error' => 'нет уйди.',
            ], 403);
        }

        $task->update([
            'title' => $request->input('title', $task->title),
            'description' => $request->input('description', $task->description),
            'deadline' => $request->input('deadline', $task->deadline),
            'priority_id' => $request->input('priority_id', $task->priority_id),
        ]);

        $userTask = UserTask::where('task_id', $task->id)->first();
        $userTask->update([
            'task_status_id'=>$request->input('task_status_id', $userTask->task_status_id)
        ]);

        return response()->json([
            'message' => 'Задача успешно обновлена!',
            'task' => $task,
            'user_task' => $userTask,
        ]);
    }

}

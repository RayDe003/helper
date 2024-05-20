<?php

namespace App\Http\Controllers\SubTasks;

use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateSubTaskController extends Controller
{

    public function updateSubTask(Request $request, Task $task,  SubTask $sub_task,) : JsonResponse
    {
        if (!$sub_task->task->users->contains(auth()->user()->id)) {
            return response()->json([
                'error' => 'нет уйди.',
            ], 403);
        }

        if(!$sub_task->task() === $task){
            return response()->json([
                'error' => 'не та  задача.',
            ], 403);
        }

        $sub_task->update([
            'text' => $request->input('text', $sub_task->text),
            'sub_status' => $request->input('sub_status', $sub_task->sub_status)
        ]);

        return response()->json([
            'message' => 'Подзадача успешно обновлена!',
            'sub_task' => $sub_task,
        ]);
    }

}

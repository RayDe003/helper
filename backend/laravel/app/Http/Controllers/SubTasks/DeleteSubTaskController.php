<?php

namespace App\Http\Controllers\SubTasks;

use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class DeleteSubTaskController extends Controller
{
    public function deleteSubTask(Task $task, SubTask $subTask): JsonResponse
    {

        if ($subTask->task_id !== $task->id) {
            return response()->json([
                'error' => 'Подзадача не принадлежит данной задаче.',
            ], 403);
        }

        $subTask->delete();

        return response()->json([
            'message' => 'Подзадача успешно удалена!',
        ]);
    }
}

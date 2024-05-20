<?php

namespace App\Http\Controllers\SubTasks;

use App\Http\Controllers\Controller;
use App\Models\SubTask;
use Illuminate\Http\JsonResponse;

class CompleteSubTask extends Controller
{
    public function updateStatus(SubTask $subTask) : JsonResponse
    {
        $subTask->is_complete = true;
        $subTask->save();

        return response()->json([
            'message' => 'Подзадача успешно обновлена!',
            'sub_task' => $subTask,
        ]);
    }
}

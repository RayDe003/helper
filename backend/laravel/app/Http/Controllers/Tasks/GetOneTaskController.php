<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;


class GetOneTaskController extends Controller
{

    public function getTask(Task $task) : JsonResponse
    {
        $this->authorize('view', $task);
        $taskWithSubTasks = $task->load('subTasks');
        return response()->json([
            'task' => $taskWithSubTasks,
        ]);

    }

}

<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;


class GetOneTaskController extends Controller
{

    public function getTask(Task $task) : JsonResponse
    {
        $this->authorize('view', $task);
        return response()->json([
            'task' => $task,
        ]);

    }

}

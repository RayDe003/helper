<?php

namespace App\Http\Controllers\SubTasks;

use App\Http\Requests\CreateSubTaskRequest;
use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CreateSubTaskController extends Controller
{
    public function create_sub_task(CreateSubTaskRequest $request, Task $task) : JsonResponse
    {
        $subTask = SubTask::create([
            'text' => $request->text,
            'task_id' => $task->id,
        ]);


        return response()->json([
            'message' => 'Подзадача успешно создана!',
            'sub_task' => $subTask,
        ]);
    }

}

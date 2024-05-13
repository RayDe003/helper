<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CreateTaskController extends Controller
{

    public function create_task(CreateTaskRequest $request) : JsonResponse
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('tasks_images', 'public');
        } else {
            $image = null;
        }

        $deadline = $request->filled('deadline') ? $request->deadline : now();

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $deadline,
            'priority_id' => $request->priority_id,
            'file' => $image
        ]);

        $userTask = UserTask::create([
            'user_id' => auth()->user()->id,
            'task_id' => $task->id,
        ]);

        return response()->json([
            'message' => 'Задача успешно создана!',
            'task' => $task,
        ]);
    }

}

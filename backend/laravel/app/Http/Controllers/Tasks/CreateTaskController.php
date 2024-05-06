<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CreateTaskController extends Controller
{

    public function create_task(Request $request) : JsonResponse
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority_id' => $request->priority_id,
        ]);

        return response()->json([
            'message' => 'Задача успешно создана!',
            'task' => $task,
        ]);
    }

}

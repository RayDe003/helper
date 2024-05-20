<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpdateTaskController extends Controller
{

    public function updateTask(Request $request, Task $task): JsonResponse
    {

        $user = Auth::user();
        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();
        if (!$userTask) {
            return response()->json([
                'error' => 'У вас нет доступа к изменению этой задачи.',
            ], 403);
        }

        // Проверяем, соответствует ли приоритет задачи допустимому диапазону значений (например, от 1 до 5)
        $priorityId = $request->input('priority_id');
        if ($priorityId < 1 || $priorityId > 3) {
            return response()->json([
                'error' => 'Недопустимое значение приоритета задачи.',
            ], 422);
        }

        // Обновляем задачу
        $task->update([
            'title' => $request->input('title', $task->title),
            'description' => $request->input('description', $task->description),
            'deadline' => $request->input('deadline', $task->deadline),
            'priority_id' => $priorityId,
        ]);

        return response()->json([
            'message' => 'Задача успешно обновлена!',
            'task' => $task,
        ]);
    }

}

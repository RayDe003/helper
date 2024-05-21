<?php

namespace App\Http\Controllers\SystemTasks;

use App\Http\Controllers\Controller;
use App\Models\RandomTasks;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteRandomTask extends Controller
{

    public function deleteRandomTask(Request $request): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Пользователь не аутентифицирован'], 401);
        }

        $randomTaskId = $request->input('random_task_id');
        $randomTask = RandomTasks::findOrFail($randomTaskId);

        if ($randomTask->userSystemTask->user_id !== $user->id) {
            return response()->json(['message' => 'Вы не можете удалить задачу другого пользователя'], 403);
        }

        $randomTask->delete();

        return response()->json(['message' => 'Задача успешно удалена']);
    }
}

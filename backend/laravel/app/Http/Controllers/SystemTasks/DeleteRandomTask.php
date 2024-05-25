<?php

namespace App\Http\Controllers\SystemTasks;

use App\Http\Controllers\Controller;
use App\Models\RandomTasks;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteRandomTask extends Controller
{

    public function deleteRandomTask($id): JsonResponse
    {
        $user = Auth::user();
        $randomTask = RandomTasks::findOrFail($id);

        if ($randomTask->userSystemTask->user_id !== $user->id) {
            return response()->json(['message' => 'Вы не можете удалить задачу другого пользователя'], 403);
        }

        $randomTask->delete();

        return response()->json(['message' => 'Задача успешно удалена']);
    }
}

<?php

namespace App\Http\Controllers\SystemTasks;

use App\Http\Controllers\Controller;
use App\Models\UsersSystemTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcceptSystemTask extends Controller
{
    public function updateAccept(Request $request, $id): JsonResponse
    {
        $user = Auth::user();

        $userSystemTask = UsersSystemTask::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$userSystemTask) {
            return response()->json(['message' => 'Задача не найдена или нет доступа'], 404);
        }

        $userSystemTask->accept = $request->input('accept');
        $userSystemTask->save();

        return response()->json([
            'message' => 'Значение accept обновлено успешно!',
            'user_system_task' => $userSystemTask,
        ]);
    }
}

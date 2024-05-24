<?php

namespace App\Http\Controllers\SystemTasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\NotFoundException;
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
            throw_unless($userSystemTask, NotFoundException::class);
        }

        $userSystemTask->accept = $request->input('accept');
        $userSystemTask->save();

        return response()->json([
            'message' => 'Значение accept обновлено успешно!',
            'user_system_task' => $userSystemTask,
        ]);
    }
}

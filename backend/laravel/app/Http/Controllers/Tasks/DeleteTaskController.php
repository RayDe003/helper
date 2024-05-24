<?php

namespace App\Http\Controllers\Tasks;

use App\Exceptions\AccessDeniedException;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteTaskController extends Controller
{
    public function deleteTask(Task $task): JsonResponse
    {
        $user = Auth::user();

        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        throw_unless($userTask, AccessDeniedException::class);

//        throw_unless(auth()->user()->id === $userTask->user_id, AccessDeniedException::class);
//
        $userTask->task->delete();
//
        return response()->json([
            'message' => 'Задача успешно удалена!',
        ]);
    }
}

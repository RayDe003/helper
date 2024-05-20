<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CompleteTaskController extends Controller
{
    public function updateStatus(Task $task): JsonResponse
    {
        $user = Auth::user();
        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        $userTask->is_complete = true;
        $userTask->save();

        return response()->json([
            'message' => 'Статус задачи успешно обновлен!',
            'user_task' => $userTask,
        ]);
    }
}

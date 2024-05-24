<?php

namespace App\Http\Controllers\SubTasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\TaskNotFoundException;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteSubTaskController extends Controller
{
    public function deleteSubTask(Task $task, SubTask $subTask): JsonResponse
    {
        $user = Auth::user();
        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        throw_unless($userTask, AccessDeniedException::class);

        if(!$subTask->task() === $task){
            throw new TaskNotFoundException ;
        }

        $subTask->delete();

        return response()->json([
            'message' => 'Подзадача успешно удалена!',
        ]);
    }
}

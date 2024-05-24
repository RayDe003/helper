<?php

namespace App\Http\Controllers\SubTasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CompleteSubTask extends Controller
{
    public function updateStatus(Task $task, SubTask $subTask) : JsonResponse
    {
        $user = Auth::user();
        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        throw_unless($userTask, AccessDeniedException::class);

        if($subTask->task_id !== $task->id){
            throw new TaskNotFoundException ;
        }

        $subTask->is_complete = true;
        $subTask->save();

        return response()->json([
            'message' => 'Подзадача успешно обновлена!',
            'sub_task' => $subTask,
        ]);
    }
}

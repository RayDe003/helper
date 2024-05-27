<?php

namespace App\Http\Controllers\SubTasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\TaskNotFoundException;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpdateSubTaskController extends Controller
{

    public function updateSubTask(Request $request, Task $task,  SubTask $sub_task,) : JsonResponse
    {
        $user = Auth::user();
        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();
        throw_unless($userTask, AccessDeniedException::class);

        if(!$sub_task->task() === $task){
            throw new TaskNotFoundException ;
        }

        $sub_task->update([
            'text' => $request->input('text', $sub_task->text),
            'sub_status' => $request->input('sub_status', $sub_task->sub_status)
        ]);

        return response()->json([
            'message' => 'Подзадача успешно обновлена!',
            'sub_task' => $sub_task,
        ]);
    }

}

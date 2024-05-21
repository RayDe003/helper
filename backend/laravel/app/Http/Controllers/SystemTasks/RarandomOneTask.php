<?php

namespace App\Http\Controllers\SystemTasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\RandomTasksResource;
use App\Http\Resources\UserSystemTaskResource;
use App\Models\RandomTasks;
use App\Models\UsersSystemTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RarandomOneTask extends Controller
{

    public function rerandomTask(Request $request): JsonResponse
    {
        $user = Auth::user();

        if ($user) {
            $randomTaskId = $request->input('random_task_id');
            $randomTask = RandomTasks::find($randomTaskId);

            if (!$randomTask) {
                return response()->json(['message' => 'Задача не найдена'], 404);
            }

            $userSystemTask = $randomTask->userSystemTask;

            if ($userSystemTask->user_id !== $user->id) {
                return response()->json(['message' => 'Вы не можете перерандомить задачу другого пользователя'], 403);
            }

            $newTask = UsersSystemTask::where('user_id', $user->id)
                ->where('accept', true)
                ->whereNotIn('id', RandomTasks::whereHas('userSystemTask', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->pluck('user_system_task_id'))
                ->inRandomOrder()
                ->first();

            if (!$newTask) {
                return response()->json(['message' => 'Нет доступных задач для перерандома'], 404);
            }

            $randomTask->update([
                'user_system_task_id' => $newTask->id,
            ]);

            return response()->json(new RandomTasksResource($randomTask));
        } else {
            return response()->json(['message' => 'Пользователь не аутентифицирован'], 401);
        }
    }
}

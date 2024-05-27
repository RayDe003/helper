<?php

namespace App\Http\Controllers\SystemTasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\RandomTasksResource;
use App\Models\RandomTasks;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RandomTasksForToday extends Controller
{
    public function randomTasksForToday(Request $request): JsonResponse
    {
        $user = Auth::user();

        $tasksForToday = $this->getTasksForToday($user);

        return RandomTasksResource::collection($tasksForToday)->response();
    }

    public function completeRandomTask(Request $request): JsonResponse
    {
        $user = Auth::user();

        $tasksForToday = $this->getTasksForToday($user);

        $randomTaskId = $request->input('random_task_id');
        $randomTask = RandomTasks::findOrFail($randomTaskId);

        if (!$tasksForToday->contains('id', $randomTaskId)) {
            throw new TaskNotFoundException ;
        }

        if ($randomTask->userSystemTask->user_id !== $user->id) {
            throw new AccessDeniedException() ;
        }

        $randomTask->is_complete = true;
        $randomTask->save();

        return response()->json([
            'message' => 'Статус задачи успешно обновлен!',
            'user_task' => new RandomTasksResource($randomTask),
        ]);
    }

    private function getTasksForToday($user)
    {
        $today = Carbon::now();

        $tasksForToday = RandomTasks::whereDate('created_at', $today)
            ->whereHas('userSystemTask', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->withTrashed()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return $tasksForToday->reject(function ($task) {
            return $task->trashed();
        });
    }
}

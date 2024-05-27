<?php

namespace App\Http\Controllers\SystemTasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\RandomTasksResource;
use App\Models\RandomTasks;
use App\Models\UsersSystemTask;
use App\Services\AchievementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RarandomOneTask extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function rerandomTask(Request $request): JsonResponse
    {
        $user = Auth::user();

            $randomTaskId = $request->input('random_task_id');
            $randomTask = RandomTasks::find($randomTaskId);

            if (!$randomTask) {
                throw new TaskNotFoundException ;
            }

            $userSystemTask = $randomTask->userSystemTask;

            if ($userSystemTask->user_id !== $user->id) {
                throw new AccessDeniedException() ;
            }

            $newTask = UsersSystemTask::where('user_id', $user->id)
                ->where('accept', true)
                ->whereNotIn('id', RandomTasks::whereHas('userSystemTask', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->pluck('user_system_task_id'))
                ->inRandomOrder()
                ->first();

            if (!$newTask) {
                throw new TaskNotFoundException ;
            }

            $randomTask->increment('rerandom_count');
            $randomTask->update([
                'user_system_task_id' => $newTask->id,
            ]);
            if ($randomTask->rerandom_count > 5) {
                $this->achievementService->updateAchievements($user, 're_random_task', 1);
            }

            return response()->json(new RandomTasksResource($randomTask));
    }
}

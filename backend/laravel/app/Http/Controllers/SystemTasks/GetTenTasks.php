<?php

namespace App\Http\Controllers\SystemTasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\RandomTasksResource;
use App\Models\RandomTasks;
use App\Models\UsersSystemTask;
use App\Services\AchievementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class GetTenTasks extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function getRandomTasks(): JsonResponse
    {
        $user = Auth::user();
            $randomTasks = UsersSystemTask::where('user_id', $user->id)
                ->where('accept', true)
                ->inRandomOrder()
                ->limit(10)
                ->with('systemTask')
                ->get();

            foreach ($randomTasks as $task) {
                RandomTasks::create([
                    'user_system_task_id' => $task->id,
                    'is_complete' => false,
                ]);
            }

            $latestRandomTasks = RandomTasks::whereHas('userSystemTask', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->with('userSystemTask.systemTask')
                ->get();

            $randomTaskCount = RandomTasks::whereHas('userSystemTask', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();

            if ($randomTaskCount >= 10) {
                $this->achievementService->updateAchievements($user, 'procrastination_mode', 1);
            }

            $taskCompletedCount = RandomTasks::whereHas('userSystemTask', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->whereHas('userSystemTask.systemTask', function ($query) {
                    $query->where('id', 20);
                })
                ->count();

            if ($taskCompletedCount >= 20) {
                $this->achievementService->updateAchievements($user, 'quiet_minute', 1);
            }

            return RandomTasksResource::collection($latestRandomTasks)->response();


    }
}

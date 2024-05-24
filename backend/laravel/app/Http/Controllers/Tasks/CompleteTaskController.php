<?php

namespace App\Http\Controllers\Tasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Services\AchievementService;

class CompleteTaskController extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function updateStatus(Task $task): JsonResponse
    {
        $user = Auth::user();

        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        throw_unless($userTask, AccessDeniedException::class);

        $this->markTaskComplete($userTask);
        $this->updateAchievements($user, $task);

        return response()->json([
            'message' => 'Статус задачи успешно обновлен!',
            'user_task' => $userTask,
        ]);
    }

    protected function markTaskComplete(UserTask $userTask)
    {
        $userTask->is_complete = true;
        $userTask->save();
    }

    protected function updateAchievements($user, Task $task)
    {
        switch ($task->priority_id) {
            case '3':
                $this->achievementService->updateAchievements($user, 'high_priority_tasks');
                break;
            case '2':
                $this->achievementService->updateAchievements($user, 'medium_priority_tasks');
                break;
            case '1':
                $this->achievementService->updateAchievements($user, 'low_priority_tasks');
                break;
        }

        $this->achievementService->updateAchievements($user, 'any_tasks');

        if ($this->tasksCompletedWithin($user, now()->subWeek())) {
            $this->achievementService->updateAchievements($user, 'daily_tasks_week');
        }

        if ($this->tasksCompletedWithin($user, now()->subMonth())) {
            $this->achievementService->updateAchievements($user, 'daily_tasks_month');
        }
    }

    protected function tasksCompletedWithin($user, $timePeriod)
    {
        return $user->tasks()->whereDate('created_at', '>', $timePeriod)->exists();
    }

}

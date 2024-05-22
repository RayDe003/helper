<?php

namespace App\Http\Controllers\Tasks;

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
        if (!$user) {
            return response()->json(['message' => 'Пользователь не аутентифицирован'], 401);
        }

        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        if (!$userTask) {
            return response()->json(['message' => 'Задача не найдена для текущего пользователя'], 404);
        }

        $userTask->is_complete = true;
        $userTask->save();

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

        $tasksCompletedThisWeek = $user->tasks()->whereDate('created_at', '>', now()->subWeek())->exists();
        if ($tasksCompletedThisWeek) {
            $this->achievementService->updateAchievements($user, 'daily_tasks_week');
        }

        $tasksCompletedThisMonth = $user->tasks()->whereDate('created_at', '>', now()->subMonth())->exists();
        if ($tasksCompletedThisMonth) {
            $this->achievementService->updateAchievements($user, 'daily_tasks_month');
        }


        return response()->json([
            'message' => 'Статус задачи успешно обновлен!',
            'user_task' => $userTask,
        ]);
    }
}

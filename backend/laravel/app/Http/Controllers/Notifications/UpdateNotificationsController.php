<?php

namespace App\Http\Controllers\Notifications;

use App\Models\Notifications;
use App\Models\Task;
use App\Services\AchievementService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateNotificationsController extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }
    public function updateNotifications(Request $request, Task $task): JsonResponse
    {
        $user = Auth::user();
        $notification = Notifications::where('task_id', $task->id)->first();

        if (!$notification) {
            return response()->json(['error' => 'Уведомление для задачи не найдено'], 404);
        }

        $notification->update([
            'not_type_id' => $request->input('not_type_id'),
            'notification_days' => json_encode($request->input('notification_days')),
        ]);

        $this->achievementService->updateAchievements($user, 'change_notification_frequency');

        return response()->json([
            'message' => 'Тип уведомления для задачи успешно обновлен',
            'notification' => $notification,
        ]);
    }
}

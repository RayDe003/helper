<?php

namespace App\Http\Controllers\Notifications;

use App\Exceptions\AccessDeniedException;
use App\Models\Notifications;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddNotificationsController extends Controller
{
    public function setNotifications(Request $request, Task $task) : JsonResponse
    {
        $user = Auth::user();

        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        throw_unless($userTask, AccessDeniedException::class);

        $notification = Notifications::create([
            'not_type_id' => $request->input('not_type_id'),
            'task_id' => $task->id,
            'notification_days' => json_encode($request->input('notification_days')),
        ]);


        return response()->json([
            'message' => 'Тип уведомления  задан',
            'notification' => $notification,
        ]);
    }

}

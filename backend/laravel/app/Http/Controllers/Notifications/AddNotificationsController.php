<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Requests\AddNotificationRequest;
use App\Models\Notifications;
use App\Models\NotType;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddNotificationsController extends Controller
{
    public function setNotifications(Request $request, Task $task) : JsonResponse
    {

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

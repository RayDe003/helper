<?php

namespace App\Http\Controllers\SystemTasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserSystemTaskResource;
use App\Models\UsersSystemTask;
use Illuminate\Http\Request;

class AllSystemTasks extends Controller
{
    public function getAllTasks(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $userSystemTasks = UsersSystemTask::where('user_id', $user->id)->get();
            return UserSystemTaskResource::collection($userSystemTasks);
        } else {
            return response()->json(['message' => 'Пользователь не аутентифицирован'], 401);
        }
    }
}

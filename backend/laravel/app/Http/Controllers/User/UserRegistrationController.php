<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SystemTask;
use App\Models\User;
use App\Models\UsersSystemTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegistrationController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $user = User::create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $systemTasks = SystemTask::all();
        foreach ($systemTasks as $task) {
            UsersSystemTask::create([
                'user_id' => $user->id,
                'system_task_id' => $task->id,
                'accept' => true, // Или любое другое значение по умолчанию
            ]);
        }

        return response()->json([
            'message' => 'Регистрация прошла успешно!',
            'user' => $user,
        ]);

    }
}

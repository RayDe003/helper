<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Achievements;
use App\Models\SystemTask;
use App\Models\User;
use App\Models\UsersAchievements;
use App\Models\UsersSystemTask;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

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
                'accept' => true,
            ]);
        }

        $achievements = Achievements::all();
        foreach ($achievements as $achievement) {
            UsersAchievements::create([
                'user_id' => $user->id,
                'achievement_id' => $achievement->id,
                'is_complete' => false,
                'progress' => 0,
            ]);
        }


        $signedRoute = URL::temporarySignedRoute('verification.verify', now()->addDay(), ['hash' => sha1($user->getEmailForVerification()), 'user' => $user]);

        $user->notify(new VerifyEmailNotification($signedRoute));

        return response()->json([
            'message' => 'Регистрация прошла успешно!',
            'user' => $user,
        ]);

    }
}

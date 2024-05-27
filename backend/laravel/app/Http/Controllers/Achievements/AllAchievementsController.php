<?php

namespace App\Http\Controllers\Achievements;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAchievementsResource;
use App\Models\UsersAchievements;
use Illuminate\Http\Request;

class AllAchievementsController extends Controller
{
    public function getAllAchievements(Request $request)
    {
        $user = $request->user();
            $userSystemTasks = UsersAchievements::where('user_id', $user->id)
                ->get();
            return UserAchievementsResource::collection($userSystemTasks);

    }
}

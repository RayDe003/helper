<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievements;
use App\Models\UsersAchievements;

class AchievementService
{
    public function updateAchievements(User $user, $type, $increment = 1)
    {
        $achievements = Achievements::where('type', $type)->get();

        foreach ($achievements as $achievement) {
            $userAchievement = UsersAchievements::firstOrCreate(
                ['user_id' => $user->id, 'achievement_id' => $achievement->id],
                ['progress' => 0, 'is_complete' => false]
            );

            if (!$userAchievement->completed) {
                $userAchievement->increment('progress', $increment);

                if ($userAchievement->progress >= $achievement->required_count) {
                    $userAchievement->update(['is_complete' => true]);
                }
            }
        }
    }
}

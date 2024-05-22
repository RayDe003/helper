<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAchievements extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'achievement_id',
        'is_complete',
        'progress'
    ];

    protected $table = 'users_achievements';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function achievement()
    {
        return $this->belongsTo(Achievements::class);
    }
}

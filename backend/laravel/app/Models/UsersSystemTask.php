<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersSystemTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'system_task_id',
        'accept'
    ];

    protected $table = 'users_system_tasks';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function systemTask()
    {
        return $this->belongsTo(SystemTask::class);
    }
}

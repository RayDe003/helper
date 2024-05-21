<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomTasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_complete',
        'user_system_task_id'
    ];

    protected $table = 'random_tasks';

    public function userSystemTask()
    {
        return $this->belongsTo(UsersSystemTask::class);
    }
}

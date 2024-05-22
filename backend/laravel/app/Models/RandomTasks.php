<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RandomTasks extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'is_complete',
        'user_system_task_id',
        'rerandom_count'
    ];

    protected $table = 'random_tasks';

    public function userSystemTask()
    {
        return $this->belongsTo(UsersSystemTask::class);
    }
}

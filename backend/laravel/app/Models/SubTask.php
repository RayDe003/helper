<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'task_id',
        'is_complete'
    ];

    protected $table = 'sub_tasks';

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function sub_status()
    {
        return $this->belongsTo(SubTaskStatus::class);
    }
}

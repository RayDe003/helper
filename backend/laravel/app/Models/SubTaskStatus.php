<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTaskStatus extends Model
{
    use HasFactory;

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }
}

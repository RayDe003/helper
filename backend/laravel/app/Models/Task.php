<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'created_at',
        'deadline',
        'priority_id',
    ];

    protected $primaryKey = 'task_id';

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function users()
    {
        return $this->hasMany(UserTask::class);
    }

}

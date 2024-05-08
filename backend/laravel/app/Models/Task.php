<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'created_at',
        'deadline',
        'file',
        'priority_id',
    ];

    protected $table = 'task';
    protected $dates = ['deleted_at'];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function users()
    {
        return $this->hasMany(UserTask::class);
    }

    public function user()
    {
        return $this->belongsTo(UserTask::class);
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }
}

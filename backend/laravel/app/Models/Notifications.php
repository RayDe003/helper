<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'not_type_id',
        'task_id',
        'notification_days'
    ];

    protected $table = 'notifications';

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function not_type()
    {
        return $this->belongsTo(NotType::class);
    }

}

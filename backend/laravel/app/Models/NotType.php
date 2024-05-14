<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotType extends Model
{
    use HasFactory;

    public function task_not()
    {
        return $this->hasMany(Notifications::class);
    }
}

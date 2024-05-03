<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    protected $primaryKey = 'priority_id';

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
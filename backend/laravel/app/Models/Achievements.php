<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'required_count',
        'type',
    ];
    protected $table = 'achievements';
}

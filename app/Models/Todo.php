<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'todo_date',
        'completed',
        'completed_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'todo_date' => 'datetime',
        'completed_at' => 'datetime',
    ];
}

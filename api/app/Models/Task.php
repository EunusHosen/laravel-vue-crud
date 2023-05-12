<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'completed',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'completed' => 'boolean',
    ];
}

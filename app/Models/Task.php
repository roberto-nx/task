<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=
    [
        
        
        'task',
        'task_description',
        'priority',
        'update_at',
        'create_at'

    ];
}
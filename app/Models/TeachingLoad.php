<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingLoad extends Model
{
    use HasFactory;

    protected $table ="teaching_loads";

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'class_id',
        'session_id',
        

    ];

    
}

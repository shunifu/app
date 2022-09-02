<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'assessement_id',
        'teacher_id',
        'mark',
        'teaching_load_id',
        'session_id'
    ];

}

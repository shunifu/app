<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessementAnswer extends Model
{
    use HasFactory;

    protected $fillable=[
        'question_id',
        'student_id',
        'student_answer',
        'student_mark',
        'assessement_id',
    ];
}

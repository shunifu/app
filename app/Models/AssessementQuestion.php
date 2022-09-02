<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessementQuestion extends Model
{
    use HasFactory;

    protected $fillable=[
        'teacher_id',
        'subject_id',
        'grade_id',
        'teaching_load_id',
        'question',
        'answer',
        'mark',
        'assessement_id',
    ];
    
}

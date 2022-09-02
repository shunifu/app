<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessementOnline extends Model
{
    use HasFactory;

    protected $fillable=[
        'teacher_id',
        'lesson_id',
        'teaching_load_id',
        'content',
        'due_date',
        'total',
        'subject_id',
        'assessement_title',
        'assessement_type',
        'timed_status',
        'timed_from',
        'timed_to',
        'lesson_topic', 

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $table ='grades_students';

    protected $fillable = [
        'student_id',
        'academic_session',
        'grade_id',
        'active',
        'student_status',
        'student_sponsor'


    ];
}

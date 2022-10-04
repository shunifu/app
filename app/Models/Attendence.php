<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;

    protected $fillable=[
        'student_id',
        'teacher_id',
        'grade_id',
        'attendence_date',
        'attendence_status'

    ];

  //  d	student_id	teacher_id	grade_id	attendence_date	attendence_status	created_at	updated_at	


}

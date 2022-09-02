<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lesson_student extends Model
{
    use HasFactory;

    protected $table='lesson_students';

    protected $fillable = [
        'student_id',
        'lesson_id',
     

    ];

}

<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GradeTeacher extends Model
{
    use HasFactory;

    protected $table='grades_teachers';

    protected $fillable = [
        'academic_session',
        'teacher_id',
        'grade_id',

    ];

//     public function teacher(){
//    return $this->hasOne(User::class, 'teacher_id');
//     }

//     public function grade(){
//         return $this->hasOne(User::class, 'teacher_id');
//     }

//     public function session(){

//     }
}

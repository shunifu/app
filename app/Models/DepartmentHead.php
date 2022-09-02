<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentHead extends Model
{
    use HasFactory;
    protected $table='department_heads';

    protected $fillable=[
        'department_id',
        'teacher_id',

    ];

}

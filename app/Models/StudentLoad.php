<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLoad extends Model
{
    use HasFactory;
    protected $table ="student_loads";

    protected $fillable = [
        'student_id',
        'teaching_load_id',

    ];
}

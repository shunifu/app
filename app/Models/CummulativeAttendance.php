<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CummulativeAttendance extends Model
{
    use HasFactory;

    protected $table='cummulative_attendances';

    protected $fillable = [
        'term_id',
        'class',
        'student_id',
        'number_of_absent_days',
    ];
}

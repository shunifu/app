<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResponse extends Model
{
    use HasFactory;
    protected $table='student_responses';

    protected $fillable = [
        'student_id',
        'assessement_id',
        'response', 
        
        

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;


    protected $fillable=[
        'grade_id',
        'academic_year',
        'active',
        'subject_id'
    ];
    
}

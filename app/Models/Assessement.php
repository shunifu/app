<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessement extends Model
{
    use HasFactory;
    protected $fillable=[
        'assessement_name',
        'term_id',
        'assessement_type',
        'marks_deadline',
        'assessement_month',
        'marks_extension'
    ];
}

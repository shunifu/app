<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'passing_rate',
        'number_of_subjects',
        'passing_subject_rule',
        'average_calculation',
        'subject_average_calculation',
        'position_type',
        'tie_type',
        'term_average_type',
        'number_of_decimal_places',


    ];
}




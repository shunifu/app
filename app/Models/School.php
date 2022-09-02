<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table='school_info';
    

    use HasFactory;


    protected $fillable = [
        'school_code',
        'school_name',
        'school_slogan',
        'school_type',
        'school_telephone',
        'school_domain',
        'school_email',
        'school_logo',
        'school_letter_head',
        'school_background_image',
    ];


}

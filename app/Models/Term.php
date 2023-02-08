<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    // protected $connection ='shunifu_console';

    protected $fillable = [
        'academic_session',
        'term_name',
        'start_date',
        'end_date',
        'final_term',
        'borders_return_date',
        'next_term_date'
        

    ];
}

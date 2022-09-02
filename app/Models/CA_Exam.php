<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CA_Exam extends Model
{
    use HasFactory;

    protected $fillable=[
        'assessement_id',
        'term_id',
        'assign_as'

    ];
}

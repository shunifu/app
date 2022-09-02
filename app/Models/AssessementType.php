<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessementType extends Model
{
    use HasFactory;
    protected $fillable=[
        'assessement_type_name',
    ];
}

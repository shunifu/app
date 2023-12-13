<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeRestriction extends Model
{
    protected $table='time_restrictions';

    use HasFactory;

    protected $guarded = [];
}

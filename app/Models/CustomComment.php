<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomComment extends Model
{
    use HasFactory;

    protected $table='custom_comments';
    protected $guarded=[];
}

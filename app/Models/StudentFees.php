<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFees extends Model
{

    protected $table ="student_fees";

    protected $guarded = [];
    use HasFactory;
}

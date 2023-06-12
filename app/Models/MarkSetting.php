<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'marks_mode',
        'effort_grade_status',
    
    ];
}

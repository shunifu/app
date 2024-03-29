<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessementWeight extends Model
{
    use HasFactory;

    protected $fillable=[
        'term_id',
        'ca_percentage',
        'mock_percentage',
        'exam_percentage',
        'stream_id',
    ];

}

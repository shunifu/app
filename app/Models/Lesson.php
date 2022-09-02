<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BeyondCode\Comments\Traits\HasComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;
    use HasComments;

    protected $table="lessons";

    protected $fillable = [
        'lesson_title',
        'lesson_summary',
        'lesson_content',
      'teaching_load_id',
      'lesson_date',
      'lesson_overview',
      'lesson_objectives',
      'lesson_graphic',
      'lesson_evaluation',
      'status',

    ];

    protected $casts = [
      'lesson_objectives' => 'array'
  ];
}

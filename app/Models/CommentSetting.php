<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentSetting extends Model

{
    use HasFactory;
    protected $table='report_comments';

    protected $fillable=[
        'section_id',
        'from',
        'to',
        'symbol',
        'comment',
        'user_type'
    ];


 

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
        'account',
        'partner',
        'description',
        'amount',
        'date',
        'financial_year',
        'ref',
    ];
}


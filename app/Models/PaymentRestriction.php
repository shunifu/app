<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRestriction extends Model
{
    protected $table='payment_restrictions';


    protected $guarded = [];
    use HasFactory;
}

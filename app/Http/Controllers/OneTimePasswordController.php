<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OneTimePasswordController extends Controller
{
    public function index(){
        return view('auth.otp');  
    }

    public function sendOTP (){

    }

  public function resendOTP(){

  }
}

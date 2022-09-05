<?php

namespace App\Http\Controllers;

use App\Models\User;
use Seshac\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use AfricasTalking\SDK\AfricasTalking;

class OneTimePasswordController extends Controller
{
    public function index(){
        return view('auth.otp');  
    }

    public function sendOTP (Request $request){
      //1. Check if user's number is registered in the system
      $userExists=User::where('cell_number', $request->auth)->where('active', 1)->first();



            //if registered =>send OTP
      if ($userExists) {


// dd($userExists);
$userID=$userExists->id;
$cellIs=$userExists->cell_number;
      
        $otp =  mt_rand(1000,9999);

        $url=substr( URL::to('/'),7);


        User::where('id', $userID)->update(['password' => Hash::make($otp)]);

        
       
        $username = config('app.sms_username');// use 'sandbox' for development in the test environment
        $apiKey   = config('app.sms_password'); // use your sandbox app API key for development in the test environment
        $AT = new AfricasTalking($username, $apiKey);
        
           // Get one of the services
           $sms      = $AT->sms();
        
           // Use the service
           $result   = $sms->send([
            'to'      => '+268'.$cellIs,
            'message' => 'Hi Your Shunifu OTP is '.$otp.'. Go to '.URL::to('/').' .If you need assistance,  WhatsApp us on 76890726. Sicela utichaze kucala. Siyabonga!',
            'from'=>'Shunifu'
        ]);

        return redirect('/login')->with('status','Password Successfully Reset! Use the code you have recieved as your password. Upon login, you will be prompted to create a new password. You will be requested to enter old password first, please use the OTP you have recieved as your old password. ');

      } else {
        return redirect('/reset')->with('error','That number is not registered in the system. Please consult the system administrator for further assistance.');
      }
      


        
        //if not registered do not send alert user that number is not register

      //2. Send OTP to 

    }

  public function resendOTP(){

  }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Seshac\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

//$otp =  Otp::generate($user);
      
        $otp =  mt_rand(1000,9999);

        $url=substr( URL::to('/'),7);


        User::where('id', $userID)->update(['password' => Hash::make($otp), 'status'=>0]);

        
       
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


  public function parent_reset_pin_method(){

    $parentExists=User::where('role_id', 10)->where('active', 1)->get();

    foreach ($parentExists as $parent) {

      $parent_id=$parent->id;
      $parent_cell=$parent->cell_number;

  $children = DB::table('parents_students')
  ->join('users', 'users.id', '=', 'parents_students.student_id')
  ->where('parents_students.parent_id',$parent_id)
  ->where('users.active', 1)
  ->whereNotNull('users.national_id')
  ->select('users.id as student_id', 'users.national_id as pin' )
  ->first();


  if(!empty($children)){
  
    $otp = $children->pin;
  }else{
  $otp="asdasdajsdklasdasdasf43";
  }
  

//$otp =  Otp::generate($user);



// $url=substr( URL::to('/'),7);


User::where('id', $parent_id)->update(['password' => Hash::make($otp), 'status'=>0]);


    }

}
}

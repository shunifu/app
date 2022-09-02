<?php

namespace App\Http\Controllers;

use Seshac\Otp\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rules\Password;

class OnboardingController extends Controller
{

    

    public function index(){

    return view('onboarding.index');

    }

    public function step_1(Request $request){
        //check if number is valid
        //check if number is in the system
        //
        $validatedData = $request->validate([
            'cell_number' => ['required','numeric'],
        ]);
        
        $user=User::where('cell_number',$request->cell_number);
        $userExists=$user->exists();
        
       
     
        if($userExists){
        $user_qry=$user->first();
        $user_id=$user_qry->id;
        $user_cell=$user_qry->cell_number;
            //CHECK if validated
$isValidated=User::where('cell_number',$request->cell_number)->where('status',1)->exists();
if($isValidated){


return redirect('/login')->with('error','Looks like you already have an account. Please login, or if you have forgotten your password, click on the Rest Password button.');
}else{

    //Generate OTP
    $generateOtp =  Otp::generate($user_id);
    $otp=$generateOtp->token;
   

$apiKey = env('SMS_API_KEY');
$apiSecret = env('SMS_API_SECRET');
$accountApiCredentials = $apiKey . ':' .$apiSecret;


$base64Credentials = base64_encode($accountApiCredentials);
$authHeader = 'Authorization: Basic ' . $base64Credentials;

$authEndpoint = 'https://rest.smsportal.com/Authentication';

$authOptions = array(
    'http' => array(
        'header'  => $authHeader,
        'method'  => 'GET',
        'ignore_errors' => true
    )
);
$authContext  = stream_context_create($authOptions);

$result = file_get_contents($authEndpoint, false, $authContext);

$authResult = json_decode($result);

$status_line = $http_response_header[0];
preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
$status = $match[1];

if ($status === '200') { 
    $authToken = $authResult->{'token'};
    
   // dd($authResult);
}
else {
   // dd($authResult);
}

$sendUrl = 'https://rest.smsportal.com/bulkmessages';

$authHeader = 'Authorization: Bearer ' . $authToken;

$sendData = '{ "messages" : [ { "senderId" : "StMichaels", "content" : "Good Day, your One Time Password is '.$otp.' It is valid for 30 minutes", "destination" : '.$user_cell.' } ] }';

$options = array(
    'http' => array(
        'header'  => array("Content-Type: application/json", $authHeader),
        'method'  => 'POST',
        'content' => $sendData,
        'ignore_errors' => true
    )
);
$context  = stream_context_create($options);

$sendResult = file_get_contents($sendUrl, false, $context);

$status_line = $http_response_header[0];
preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
$status = $match[1];

if ($status === '200') {
    //dd($sendResult);
    
   return view('onboarding.otp', compact('user_cell'));
}
else {
    //dd($sendResult);
}

}
    //SEND OTP

        }else{

            return redirect('/create/account/')->with('error','Your number is not registered in the system. Please consult the system administrator for further assistance.');

        }
      //  $user=$getNumber->cell_number;


    }

    public function step_2(Request $request){
        //Processing the OTP

      //  dd($request->all());
      $otp=$request->otp;
        $user=User::where('cell_number', $request->cell_number)->first();
        $identifier=$user->id;

        $verify = Otp::validate($identifier, $otp);

        if($verify->status=="true" AND $verify->message=="OTP is valid"){
            //successful
            //Update status to 1
            $update=User::find($identifier)->update(['status'=>'1']);
            $user_id=Crypt::encrypt($user); 
           return redirect()->route('onboarding.profile_setup', ['user' => $user_id]);
        }else{
            dd($verify);
        }


    }

    public function profile_setup($user){
    //    dd($user);
        $user_dycrpt = Crypt::decrypt($user);
        $user_id=$user_dycrpt->id;
        return view('onboarding.otp-success', compact('user_id'));
    }

    public function step_3(Request $request){
       // dd($request->all());
$user_id=$request->user_id;
       // Validations
        $request->validate([
            'firstname' => ['required','alpha'],
            'lastname' => ['required','alpha'],
            'email'=>['required','email'],
           'password' =>  ['required',
            'confirmed',
            Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
           ]

        ]);

        
        
        //1. Update users->email, name, lastname, salutation, password
        //2. Login the users

       $hashed= Hash::make($request->password);
     
       //Update User     
$update=User::find($user_id)->update(['name'=>$request->firstname, 'salutation'=>$request->salutation,'lastname'=>$request->lastname, 'email'=>$request->email, 'password'=>$hashed] );

// $request->session->flush();
Auth::loginUsingId($user_id);
return redirect()->intended('dashboard');

       
    }
}


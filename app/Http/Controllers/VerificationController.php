<?php

namespace App\Http\Controllers;

use Seshac\Otp\Otp;
use App\Models\Role;
use App\Models\User;
use Clickatell\Rest;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Clickatell\ClickatellException;

class VerificationController extends Controller
{
 public function index(){

    //Show form

    return view('auth.otp');

    //$verify = Otp::validate($user, $otp->token);

     
 }


 public function generateOtp(){

    

    //Workflow
    //1. Get all users who meet criteria
    //2. Foreach user, generate otp
    //3. //Send SMS


    


  //  $users=User::where('role_id',10)->where('isVerified', 0)->where('cell_number',76890726)->get();



//   $clickatell = new \Clickatell\Rest();

// print_r($clickatell);
// // Full list of support parameters can be found at https://www.clickatell.com/developers/api-documentation/rest-api-request-parameters/
// try {
//     $result = $clickatell->sendMessage(['to' => ['26876890726'], 'content' => 'Ola']);
//     dd($result);

//     foreach ($result['messages'] as $message) {
//         var_dump($message);

//         /*
//         [
//             'apiMsgId'  => null|string,
//             'accepted'  => boolean,
//             'to'        => string,
//             'error'     => null|string
//         ]
//         */
//     }

// } catch (ClickatellException $e) {
//     // Any API call error will be thrown and should be handled appropriately.
//     // The API does not return error codes, so it's best to rely on error descriptions.
//     var_dump($e->getMessage());
    
//     // foreach($users as $user){
//     //     $generateOtp=Otp::generate($user->cell_number, 5, 60);
//     // }
    

//  }

// "https://platform.clickatell.com/messages/http/send?apiKey=fvYg3WQ4TsS2jwkgTbbcLw==&to=26876890726&content=Test+message+text"
$response = Curl::to('https://platform.clickatell.com/messages/http/send?apiKey=fvYg3WQ4TsS2jwkgTbbcLw==&senderid=Shunifu&to=26876890726&content=GoodDay')
->get();

dd($response);

//  $post = array('channel'=>'sms', 'to' => '26876890726', 'content' => 'Ola');
 
//  $ch = curl_init();

//  curl_setopt($ch, CURLOPT_URL, 'https://platform.clickatell.com/messages/http/send?apiKey=fvYg3WQ4TsS2jwkgTbbcLw==&to=26876890726&content=Test+message+text');
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//  curl_setopt($ch, CURLOPT_POST, 1);
//  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
 
//  $headers = array();
//  $headers[] = 'Content-Type: application/json';
//  $headers[] = 'Accept: application/json';
//  $headers[] = 'Authorization: zj4B1ZgyRmSLKOXvzLtQnw==';
//  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 
//  $result = curl_exec($ch);
// dd($result);

//  if (curl_errno($ch)) {
//      echo 'Error:' . curl_error($ch);
//  }
//  curl_close($ch);

//  $response = Curl::to('https://platform.clickatell.com/v1/message')

//                 ->withData( ['channel'=>'sms', 'to' => ['26876890726'], 'content' => 'Ola'])

//                 ->post();

//     dd($response);



}

 public function process_otp(Request $request){

    $parent_role=Role::where('name', 'parent')->first();
    

  
     //OTP process

     //1. Get User
     $user=User::where('cell_number', $request->cell)->where('role_id',$parent_role->id)->first();
     
     if(is_null($user)){
         //if there is no user associated with that number
         return view('auth.otp')->with('error', 'Number not found in system');

     }else{
    //1. User is in system

    //1. Generate OTP
    $generateOtp=Otp::generate($user->id);
    // Otp::validate(string $identifier, string $token)

    //Send SMS to parent



     }


 }

 public function validateOTP(Request $request){
     //2. Validate OTP
     $verify = Otp::validate($user->id, $request->otp);
    

    if($verify->status=="false"){

 return view('auth.otp')->with('error', $verify->message);
    }else{

        //true


        return view('auth.otp')->with('error', 'Number not found in system');

    }
 }
}

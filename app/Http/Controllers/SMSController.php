<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;

class SMSController extends Controller
{
    public function astute(){

    //create loop for all teachers
 
    


    //
  

$username = 'shunifu-sms'; // use 'sandbox' for development in the test environment
$apiKey   = '142c0016b4509263bc833bb83816a5e993be7a1cba74531567ac39700f5461ec'; // use your sandbox app API key for development in the test environment
$AT       = new AfricasTalking($username, $apiKey);

// Get one of the services
$sms      = $AT->sms();

// Use the service
$result   = $sms->send([
    'to'      => '+26876890726',
    'message' => 'Hi, Angie. Welcome to the Shunifu Platform. You will soon recieve an OTP to login to the Shunifu System https://swazinationalhigh.shunifu.app',
    'from'=>'Shunifu'
]);

dd($result);
    }
}

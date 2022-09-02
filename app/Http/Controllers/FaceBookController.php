<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FaceBookController extends Controller
{
/**
 * Login Using Facebook
 */
 public function loginUsingFacebook()
 {
    return Socialite::driver('facebook')->redirect();
 }

 public function callbackFromFacebook()
 {
  try {
       $user = Socialite::driver('facebook')->user();

       dd($user);

       if((!empty($finduser))){
       
        Auth::login($finduser);

        //
        
        return redirect()->intended('dashboard');

    }else{
return redirect('/login')->with('error','That account is not registered in the system. Please consult the system administrator for further assistance.');
      
    }

       return redirect()->route('home');
       } catch (\Throwable $th) {
          throw $th;
       }
   }
}
<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\FaceBookController;

class OauthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user =Socialite::driver('google')->stateless()->user();
          
            $finduser=User::where(['email' => $user->getEmail()])->where('active', 1)->first();   
            

            if((!empty($finduser))){

                if($finduser->status==0){
                    $finduser->status=1;
                    $finduser->save();
                }
               
       
                Auth::login($finduser);

                //
                
                return redirect()->intended('dashboard');
       
            }else{
 return redirect('/login')->with('error','That account is not registered in the system. Please consult the system administrator for further assistance.');
              
            }
            
      
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function handleFacebookCallback()
    {
        try {
      
            $user =Socialite::driver('facebook')->stateless()->user();
            dd($user);
          
            $finduser=User::where(['email' => $user->getEmail()])->where('active', 1)->first();   
            

            if((!empty($finduser))){
       
                Auth::login($finduser);

                //
                
                return redirect()->intended('dashboard');
       
            }else{
 return redirect('/login')->with('error','That account is not registered in the system. Please consult the system administrator for further assistance.');
              
            }
            
      
        } catch (Exception $e) {
            dd($e);
        }
    }
}

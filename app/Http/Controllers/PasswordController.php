<?php

namespace App\Http\Controllers;

use Seshac\Otp\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function change(Request $request)
    {
        $old_password=$request->old_password;
        $new_password=$request->new_password;
        $confirm_password=$request->confirm_password;
      //   dd($request->all());
        $validatedData = $request->validate([
            'old_password' => 'required',
            // 'new_password' => 'required|string|min:9|confirmed',
            'confirm_password' => 'required',
            'new_password' =>  ['required',
            Password::min(6)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
           ]
        ]);

    

        $identifier=Auth::user()->id;
        $cell_number=Auth::user()->cell_number;
        $otp =  Otp::generate($identifier);
        
        $user_otp = Otp::validate($identifier, $otp->token);


      if($user_otp->status=="true"){
        
        User::find($identifier)->update([
            'password'=>Hash::make($otp->token),

        ]);
      }else{
        flash()->overlay('<i class="fas fa-exclamation-circle text-warning"></i> Error. Please double check the old password. Please try again', 'Change Password');
      }


        if ((!(Hash::check($old_password, Auth::user()->password)))) {
         //   The passwords does match
            flash()->overlay('<i class="fas fa-exclamation-circle text-warning"></i> Error. Your current password does not match with the password you provided. Please try again', 'Change Password');
          //  return redirect()->back();
            // return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($old_password, $new_password) == 0){
            //Current password and new password are same
            flash()->overlay('<i class="fas fa-exclamation-circle text-warning"></i> Error. Your current password and new password you provided are the same. Please try again', 'Change Password');
            return redirect()->back();
        }

        if(strcmp($new_password, $cell_number) == 0){
            //Current password and new password are same
            flash()->overlay('<i class="fas fa-exclamation-circle text-warning"></i> Error. Your cell number pho? '.Auth::user()->name.' Please try again, but not your cell number as your password.', 'Change Password');
            return redirect()->back();
        }

        if(!($new_password==$confirm_password)){
            //Current password and new password are same
            flash()->overlay('<i class="fas fa-exclamation-circle text-warning"></i> Error. The confirm password and new password do not match', 'Change Password');
            return redirect()->back();
        }


     

        #Update the new Password
       $update= User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($new_password),
            'status'=>1,
        ]);

        // flash()->overlay('<i class="fa5-tick text-success"></i> Success. You have successfully updated your password', 'Change Password');
        // return redirect('/teacher/view/{id}');
        Session::flush();
        
        Auth::logout();


        // flash()->overlay('<i class="fas fa-exclamation-check text-success"></i> Success. Password successfully changed, login with new credentials.', 'Login');
        // return redirect('login');

        return redirect('login')->with("success","Password successfully changed, login with new credentials.");
      //  return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
 

       

    }

}
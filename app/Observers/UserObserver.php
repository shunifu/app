<?php

namespace App\Observers;

use Seshac\Otp\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
     
//Generate OTP
//1. Only when user has a cell number

// if(!empty($user->cell_number)){

//     //1. Generate OTP
//     $otp=Otp::generate($user);

   

//     //2. Send it to user via SMS via notification class



//     // $verify = Otp::validate($user, $otp->token);

// }else{

}

        
    

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //1. check updated column
        //2. if cell/email updated

        //3. 
        //3. then generate OTP
        //reset password
        //temporary block account
        //4. send via appropiate channel
        //5. 
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}

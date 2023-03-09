<?php

namespace App\Providers;

use Error;
use Carbon\Carbon;
use Seshac\Otp\Otp;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        
        Fortify::authenticateUsing(function (Request $request) {


            //Status represents OTP Verification
            
            
            //Check if status==1
            //if status ==1
            //means OTP has been verified


            //if status==0
            //means not verfied

            $user = User::where('email', $request->auth)
                            ->where('active', 1)
                            
                            ->orWhere('cell_number', $request->auth)
                            ->first();


                   //      dd($user);

            if ($user && Hash::check($request->password, $user->password )) {
                return $user;
            }
            // if($user && $user->status==0){

                //check if entered OTP is valid
            //    $checkOTP = Otp::validate($user->id);

              //  dd($checkOTP);

                //if OTP is not valid
                //1. Alert user that OTP is not valid



                //if OTP is valid 
                //
         
               
                // $otp_time=$hasExpired->expired_at->format('Y-m-d H:i:s');

                // $now = Carbon::now()->format('Y-m-d H:i:s');
                // $now_time= new Carbon($now);
                // $onetimepin_time= new Carbon($otp_time);
              
                // $diff = $onetimepin_time->diffInMinutes($now_time);
                // // dd($diff);

                // if($diff==0 OR $diff<0){
                //     //otp has expired
                //      //if OTP has expired
                //     //1. Tell the user that he has the OTP has expired & when it expired
                //     //when =
                //   //  dd($hasExpired);
                //   $request->session()->flash('error', 'The OTP you entered expired. Please consult system admin for further assistance. Siyabonga');
                //   return false;
                // }

                // if($diff>0 ){
                    //OTP is still active
                 

                // $request->session()->flash('error', 'Login credentials incorrect. If problem persists please consult the system administrator. Siyabonga!');
                // return false;
                
        

               
      
                // }
            
            if(!($user && Hash::check($request->password, $user->password))){
                $request->session()->flash('error', 'Login credentials incorrect. If problem persists please consult the system administrator. Siyabonga!');
                return false;

            }
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}

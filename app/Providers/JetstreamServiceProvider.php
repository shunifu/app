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
          
            
            if(!($user && Hash::check($request->password, $user->password))){
                $request->session()->flash('error', 'Login details are incorrect. Either or username or password is wrong.  If problem persists please consult the system administrator. Siyabonga!');
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

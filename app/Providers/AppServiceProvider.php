<?php

namespace App\Providers;

use App\Models\School;
use App\Models\User;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository; //allow setting of app config values

class AppServiceProvider extends ServiceProvider
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
    public function boot(Repository $appConfig)
    {
        // JetstrapFacade::bootstrap4();
        // JetstrapFacade::useAdminLte3();

      
    //    URL::forceScheme('https');
  
       // Paginator::useBootstrap();
        
       $this->app['request']->server->set('HTTPS','on');
       URL::forceScheme('https');
        
  Schema::defaultStringLength(191);


  $config = School::first(); //get the values you want to use

  


$appConfig->set('app.school_logo', $config->school_logo);
$appConfig->set('app.school_name', $config->school_name);

//dd(config('app.school_logo'));



 }

}


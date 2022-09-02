<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use NascentAfrica\Jetstrap\JetstrapFacade;

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
    public function boot()
    {
        JetstrapFacade::bootstrap4();
        JetstrapFacade::useAdminLte3();

        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        //dd(env('APP_ENV'));

        // If (env('APP_ENV') !== 'local') {
        //     $this->app['request']->server->set('HTTPS', true);
        //         }else{
        //           $this->app['request']->server->set('HTTPS', false);
        //         }
  Schema::defaultStringLength(191);

// User::observe(UserObserver::class);
 }

}


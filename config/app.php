<?php



use Illuminate\Support\Facades\Facade;

return [

/*
|--------------------------------------------------------------------------
| Application Name
|--------------------------------------------------------------------------
|
| This value is the name of your application. This value is used when the
| framework needs to place the application's name in a notification or
| any other location as required by the application or its packages.
|
*/

'name' => env('APP_NAME', "Shunifu"),

/*
|--------------------------------------------------------------------------
| Application Environment
|--------------------------------------------------------------------------
|
| This value determines the "environment" your application is currently
| running in. This may determine how you prefer to configure various
| services the application utilizes. Set this in your ".env" file.
|
*/

'env' => env('APP_ENV', 'production'),

/*
|--------------------------------------------------------------------------
| Application Debug Mode
|--------------------------------------------------------------------------
|
| When your application is in debug mode, detailed error messages with
| stack traces will be shown on every error that occurs within your
| application. If disabled, a simple generic error page is shown.
|
*/

'debug' => (bool) env('APP_DEBUG', false),

/*
|--------------------------------------------------------------------------
| Application URL
|--------------------------------------------------------------------------
|
| This URL is used by the console to properly generate URLs when using
| the Artisan command line tool. You should set this to the root of
| your application so that it is used when running Artisan tasks.
|
*/




'url' => env('APP_URL', "Shunifu"),

'asset_url' => env('ASSET_URL', null),

/*
|--------------------------------------------------------------------------
| Application Timezone
|--------------------------------------------------------------------------
|
| Here you may specify the default timezone for your application, which
| will be used by the PHP date and date-time functions. We have gone
| ahead and set this to a sensible default for you out of the box.
|
*/

'timezone' => 'Africa/Mbabane',

/*
|--------------------------------------------------------------------------
| Application Locale Configuration
|--------------------------------------------------------------------------
|
| The application locale determines the default locale that will be used
| by the translation service provider. You are free to set this value
| to any of the locales which will be supported by the application.
|
*/

'locale' => 'en',

/*
|--------------------------------------------------------------------------
| Application Fallback Locale
|--------------------------------------------------------------------------
|
| The fallback locale determines the locale to use when the current one
| is not available. You may change the value to correspond to any of
| the language folders that are provided through your application.
|
*/

'fallback_locale' => 'en',

/*
|--------------------------------------------------------------------------
| Faker Locale
|--------------------------------------------------------------------------
|
| This locale will be used by the Faker PHP library when generating fake
| data for your database seeds. For example, this will be used to get
| localized telephone numbers, street address information and more.
|
*/

'faker_locale' => 'en_US',

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| This key is used by the Illuminate encrypter service and should be set
| to a random, 32 character string, otherwise these encrypted strings
| will not be safe. Please do this before deploying an application!
|
*/

'key' => 'base64:2qLf/+DALcgsppX84xz24a4/9l39+8Ef2bQrMBRH4gg=',
'cipher' => 'AES-256-CBC',




'sms_username' => 'shunifu-sms',
'sms_password' => '142c0016b4509263bc833bb83816a5e993be7a1cba74531567ac39700f5461ec',
'sms_from'=>'Shunifu',





// 'DB_CONNECTION' => 'mysql',
// 'DB_HOST' => "SG-grape-laugh-9477-7606-mysql-master.servers.mongodirector.com",
// 'DB_PORT' => '3306',
// 'DB_DATABASE' => env('DB_NAME'),
// 'DB_USERNAME' => 'sgroot',
// 'DB_PASSWORD'=>'Wo835nKf@TS4aE04',

// 'APP_DEBUG' => 'false',
// 'APP_ENV' => 'production',


// 'DB_CONNECTION' => 'mysql',
// 'DB_HOST' => "SG-mud-sleep-7178-7754-mysql-master.servers.mongodirector.com",
// 'DB_PORT' => '3306',
// 'DB_DATABASE' => env('DB_NAME'),
// 'DB_USERNAME' => 'sgroot',
// 'DB_PASSWORD'=>'eXk7@XmEYb9r9KZ9',


// 'DB_CONNECTION' => 'mysql',
// 'DB_HOST' => "SG-last-scalegrid-7885-mysql-master.servers.mongodirector.com",
// 'DB_PORT' => '3306',
// 'DB_DATABASE' => env('DB_NAME'),
// 'DB_USERNAME' => 'sgroot',
// 'DB_PASSWORD'=>'VcqNno+iRTeqLc8c',

// 'APP_DEBUG' => 'false',
// 'APP_ENV' => 'production',


// 'DB_CONNECTION' => 'mysql',
// 'DB_HOST' => "SG-gcina-8009-mysql-master.servers.mongodirector.com",
// 'DB_PORT' => '3306',
// 'DB_DATABASE' => env('DB_NAME'),
// 'DB_USERNAME' => 'sgroot',
// 'DB_PASSWORD'=>'orIaQ46rsN+y14oQ',


// if (App::environment('local')) {
//     // The environment is local
// }

// 'DB_CONNECTION' => 'mysql',
// 'DB_HOST' => "127.0.0.1",
// 'DB_PORT' => '3306',
// 'DB_DATABASE' => env('DB_NAME'),
// 'DB_USERNAME' => 'root',
// 'DB_PASSWORD'=>'',

'DB_CONNECTION' => 'mysql',
'DB_HOST' => "SG-yibanomusa-8169-mysql-master.servers.mongodirector.com",
'DB_PORT' => '3306',
'DB_DATABASE' => env('DB_NAME'),
'DB_USERNAME' => 'sgroot',
'DB_PASSWORD'=>'J7eEJ@VVDlRoAa49',


// 'DB_CONNECTION' => 'shunifuservices',
// 'DB_SHUNIFU_SERVICES' => 'shunifuservices',



// 'DB_CONNECTION' => 'mysql',
// 'DB_HOST' => "ypc8xu1divj9z5cj.cbetxkdyhwsb.us-east-1.rds.amazonaws.com",
// 'DB_PORT' => '3306',
// 'DB_DATABASE' => env('DB_NAME'),
// 'DB_USERNAME' => 'r9xoialesfxre2fb',
// 'DB_PASSWORD'=>'hdy7q3v7xcubgglt',

'DB_CONNECTION_CENTRAL'=>'shunifu_console',
'DB_HOST_CENTRAL'=>'127.0.0.1',
'DB_PORT_CENTRAL'=>'3306',
'DB_DATABASE_CENTRAL'=>'shunifu_central',
'DB_USERNAME_CENTRAL'=>'rooT',
'DB_PASSWORD_CENTRAL'=>'DFFGDG',

'GOOGLE_CLIENT_ID'=>"647711867996-0g1vr98vus94v8p37oo5u6sb6b3opder.apps.googleusercontent.com",
'GOOGLE_CLIENT_SECRET'=>"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",
'GOOGLE_REDIRECT_URL'=>"/redirect/google",

'CLOUDINARY_URL'=>'cloudinary://884547925317869:B-IO0MYnPfVb1Lm9Lsx3KvjXUxM@doramr0cr',
'CLOUDINARY_PRESET'=>'XXXXXXXXXXXXX',
'CLOUDINARY_NOTIFICATION_URL'=>'',

/*
|--------------------------------------------------------------------------
| Autoloaded Service Providers
|--------------------------------------------------------------------------
|
| The service providers listed here will be automatically loaded on the
| request to your application. Feel free to add your own services to
| this array to grant expanded functionality to your applications.
|
*/

'providers' => [

    /*
        * Laravel Framework Service Providers...
        */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    Illuminate\Database\DatabaseServiceProvider::class,
    Illuminate\Encryption\EncryptionServiceProvider::class,
    Illuminate\Filesystem\FilesystemServiceProvider::class,
    Illuminate\Foundation\Providers\FoundationServiceProvider::class,
    Illuminate\Hashing\HashServiceProvider::class,
    Illuminate\Mail\MailServiceProvider::class,
    Illuminate\Notifications\NotificationServiceProvider::class,
    Illuminate\Pagination\PaginationServiceProvider::class,
    Illuminate\Pipeline\PipelineServiceProvider::class,
    Illuminate\Queue\QueueServiceProvider::class,
    Illuminate\Redis\RedisServiceProvider::class,
    Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
    Illuminate\Session\SessionServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
    Illuminate\View\ViewServiceProvider::class,
    // \Yajra\Datatables\DataTablesServiceProvider::class,
    // Intervention\Image\ImageServiceProvider::class,
    // Barryvdh\Snappy\ServiceProvider::class,



    /*
        * Package Service Providers...
        */

    /*
        * Application Service Providers...
        */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    // App\Providers\BroadcastServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\BiServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    // App\Providers\TenancyServiceProvider::class, // <-- here
    App\Providers\FortifyServiceProvider::class,
    App\Providers\JetstreamServiceProvider::class,
    // Barryvdh\DomPDF\ServiceProvider::class,
    CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider::class,


    //  Clickatell\ClickatellServiceProvider::class,


],

/*
|--------------------------------------------------------------------------
| Class Aliases
|--------------------------------------------------------------------------
|
| This array of class aliases will be registered when this application
| is started. However, feel free to register as many as you wish as
| the aliases are "lazy" loaded so they don't hinder performance.
|
*/

'aliases' => [

    'App' => Illuminate\Support\Facades\App::class,
    'Arr' => Illuminate\Support\Arr::class,
    'Artisan' => Illuminate\Support\Facades\Artisan::class,
    'Auth' => Illuminate\Support\Facades\Auth::class,
    'Blade' => Illuminate\Support\Facades\Blade::class,
    'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
    'Bus' => Illuminate\Support\Facades\Bus::class,
    'Cache' => Illuminate\Support\Facades\Cache::class,
    'Config' => Illuminate\Support\Facades\Config::class,
    'Cookie' => Illuminate\Support\Facades\Cookie::class,
    'Crypt' => Illuminate\Support\Facades\Crypt::class,
    'DB' => Illuminate\Support\Facades\DB::class,
    'Eloquent' => Illuminate\Database\Eloquent\Model::class,
    'Event' => Illuminate\Support\Facades\Event::class,
    'File' => Illuminate\Support\Facades\File::class,
    'Gate' => Illuminate\Support\Facades\Gate::class,
    'Hash' => Illuminate\Support\Facades\Hash::class,
    'Http' => Illuminate\Support\Facades\Http::class,
    'Lang' => Illuminate\Support\Facades\Lang::class,
    'Log' => Illuminate\Support\Facades\Log::class,
    'Mail' => Illuminate\Support\Facades\Mail::class,
    'Notification' => Illuminate\Support\Facades\Notification::class,
    'Password' => Illuminate\Support\Facades\Password::class,
    'Queue' => Illuminate\Support\Facades\Queue::class,
    'Redirect' => Illuminate\Support\Facades\Redirect::class,
    // 'Redis' => Illuminate\Support\Facades\Redis::class,
    'Request' => Illuminate\Support\Facades\Request::class,
    'Response' => Illuminate\Support\Facades\Response::class,
    'Route' => Illuminate\Support\Facades\Route::class,
    'Schema' => Illuminate\Support\Facades\Schema::class,
    'Session' => Illuminate\Support\Facades\Session::class,
    'Storage' => Illuminate\Support\Facades\Storage::class,
    'Str' => Illuminate\Support\Str::class,
    'URL' => Illuminate\Support\Facades\URL::class,
    'Validator' => Illuminate\Support\Facades\Validator::class,
    'View' => Illuminate\Support\Facades\View::class,
    'PDF' => Barryvdh\DomPDF\Facade::class,
    'DataTables' => Yajra\DataTables\Facades\DataTables::class,
    'Clickatell' => Clickatell\ClickatellFacade::class,
    'Cloudinary' => CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::class,
    'LaravelPwa' => \Ladumor\LaravelPwa\LaravelPwa::class,
    'Image' => Intervention\Image\Facades\Image::class,
    'aliases' => Facade::defaultAliases()->merge([
        'Image' => \Intervention\Image\Facades\Image::class,
    ])->toArray(),
    'PDF' => Barryvdh\Snappy\Facades\SnappyPdf::class,
'SnappyImage' => Barryvdh\Snappy\Facades\SnappyImage::class

],

];

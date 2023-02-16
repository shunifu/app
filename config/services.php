<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => "647711867996-0g1vr98vus94v8p37oo5u6sb6b3opder.apps.googleusercontent.com",
        'client_secret' => "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",
        'redirect' => '/auth/google/callback/',
    ],

    'facebook' => [
        'client_id' => '1867760346766384', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '355cfedb9ede282befa6b1a0e927e325', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'https://examplelaravel8.test/facebook/callback/'
    ],

];

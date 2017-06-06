<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '600314140160629',
        'client_secret' => 'efa4f5d390793aa7b50d86f737db56f5',
        'redirect' => 'http://localhost/realtime/public/facebook/callback',
    ],
    'google' => [
        'client_id' => '588847129092-3eu54e42tquk6hl56r1iv6088g0hla7q.apps.googleusercontent.com',
        'client_secret' => 'iBNPfolVRkw4RcP4EwKqaM-V',
        'redirect' => 'http://localhost/realtime/public/google/callback',
    ],

];

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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase'=>[
    'apiKey'=>"AIzaSyAc9BAKTEV-xJXbXC-8uhBiEJ0wxuRfgrU",
    'authDomain'=>"note-app-3a73c.firebaseapp.com",
    'databaseURL'=> "https://note-app-3a73c-default-rtdb.europe-west1.firebasedatabase.app",
    'projectId'=>"note-app-3a73c",
    'storageBucket'=> "note-app-3a73c.appspot.com",
    'messagingSenderId'=> "165140820270",
    'appId'=> "1:165140820270:web:73824ebc52afa42cd1cabf",
    'measurementId'=> "G-PW81EVN3KR"
    ],

 

];

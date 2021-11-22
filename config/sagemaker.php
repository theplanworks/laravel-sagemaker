<?php
// config for ThePLAN/LaravelSagemaker
return [
    // AWS SDK Client Version
    'version' => env('AWS_SAGEMAKER_CLIENT_VERSION', '2017-05-13'),

    // AWS Region
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),

    // AWS Credentials
    'credentials'       => [
        'key'    => env('AWS_ACCESS_KEY_ID', ''),
        'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
    ],
];

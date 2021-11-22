<?php
// config for ThePLAN/LaravelSagemaker
return [
    // AWS SDK Client Version
    'version' => env('AWS_SAGEMAKER_CLIENT_VERSION', '2017-05-13'),

    // AWS Region
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
];

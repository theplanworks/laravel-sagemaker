<?php

namespace ThePLAN\LaravelSagemaker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ThePLAN\LaravelSagemaker\LaravelSagemaker
 */
class LaravelSagemaker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-sagemaker';
    }
}

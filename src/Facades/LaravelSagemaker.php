<?php

namespace ThePLAN\LaravelSagemaker\Facades;

use Illuminate\Support\Facades\Facade;
use ThePLAN\LaravelSagemaker\LaravelSagemaker as Sagemaker;

/**
 * @see \ThePLAN\LaravelSagemaker\LaravelSagemaker
 */
class LaravelSagemaker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Sagemaker::class;
    }
}

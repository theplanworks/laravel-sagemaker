<?php

namespace ThePLAN\LaravelSagemaker;

use Aws\SageMakerRuntime\SageMakerRuntimeClient;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class LaravelSagemakerServiceProvider extends PackageServiceProvider implements DeferrableProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * Package Configuration
         */
        $package
            ->name('laravel-sagemaker')
            ->hasConfigFile();
    }
}

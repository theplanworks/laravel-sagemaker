<?php

namespace ThePLAN\LaravelSagemaker;

use Illuminate\Contracts\Support\DeferrableProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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

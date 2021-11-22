<?php

namespace ThePLAN\LaravelSagemaker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ThePLAN\LaravelSagemaker\Commands\LaravelSagemakerCommand;

class LaravelSagemakerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-sagemaker')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-sagemaker_table')
            ->hasCommand(LaravelSagemakerCommand::class);
    }
}

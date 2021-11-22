<?php

namespace ThePLAN\LaravelSagemaker;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Application;
use Spatie\LaravelPackageTools\Package;
use Aws\SageMakerRuntime\SageMakerRuntimeClient;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSagemakerServiceProvider extends PackageServiceProvider
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

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(LaravelSagemaker::class, function (Application $app) {
            $config = [
                'region' => config('sagemaker.region'),
                'version' => config('sagemaker.version'),
            ];

            $credentials = config('sagemaker.credentials');

            if (! empty($credentials['key']) && ! empty($credentials['secret'])) {
                $config['credentials'] = Arr::only($credentials, ['key', 'secret', 'token']);
            }

            return new LaravelSagemaker(
                new SageMakerRuntimeClient($config)
            );
        });
    }
}

<?php

namespace ThePLAN\LaravelSagemaker;

use Aws\SageMakerRuntime\SageMakerRuntimeClient;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Spatie\LaravelPackageTools\Package;
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

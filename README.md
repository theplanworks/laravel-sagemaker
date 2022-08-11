# Interface with AWS Sagemaker Instances from your Laravel App

[![Latest Version on Packagist](https://img.shields.io/packagist/v/theplan/laravel-sagemaker.svg?style=flat-square)](https://packagist.org/packages/theplan/laravel-sagemaker)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/theplan/laravel-sagemaker/run-tests?label=tests)](https://github.com/theplan/laravel-sagemaker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/theplan/laravel-sagemaker/Check%20&%20fix%20styling?label=code%20style)](https://github.com/theplan/laravel-sagemaker/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/theplan/laravel-sagemaker.svg?style=flat-square)](https://packagist.org/packages/theplan/laravel-sagemaker)

---

AWS Sagemaker is a powerful platform to both train and run Machine Learning models. This package allows you to easily integrate Sagemaker endpoints into your Laravel 8+ Applications.

## Installation

You can install the package via composer:

```bash
composer require theplan/laravel-sagemaker
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-sagemaker-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$result = LaravelSagemaker::forEndpoint('my-endpoint-name')
                          ->body($body)
                          ->async()
                          ->contentType('application/json')
                          ->invoke();

echo $result->get('predictions');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [thePLAN](https://github.com/theplanworks)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

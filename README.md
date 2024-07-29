# Работа с информацией из Wordpress в Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ichinya/lara-wp.svg?style=flat-square)](https://packagist.org/packages/ichinya/lara-wp)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ichinya/lara-wp/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ichinya/lara-wp/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ichinya/lara-wp/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ichinya/lara-wp/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ichinya/lara-wp.svg?style=flat-square)](https://packagist.org/packages/ichinya/lara-wp)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

Проблемы или дополнения пишите [в соответсвующий раздел на GitHub](https://github.com/Ichinya/lara-wp/issues)

## Installation

You can install the package via composer:

```bash
composer require ichinya/lara-wp
```


You can publish the config file with:

```bash
php artisan vendor:publish --tag="lara-wp-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="lara-wp-views"
```

## Usage

```php
$post = \Ichinya\LaraWP\Models\Post::find(1);
# or
$post =  \Ichinya\LaraWP\Models\Post::query()->with('meta')->status(PostStatuses::Draft)->first();
# or
$post =  \Ichinya\LaraWP\Models\Post::query()->with('meta')->published()->first(); 
dd($post);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ичи](https://github.com/Ichinya)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

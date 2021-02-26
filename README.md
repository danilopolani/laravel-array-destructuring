# Laravel Array Destructuring

[![Latest Version on Packagist](https://img.shields.io/packagist/v/danilopolani/laravel-array-destructuring.svg?style=flat-square)](https://packagist.org/packages/danilopolani/laravel-array-destructuring)
[![Build Status](https://travis-ci.com/danilopolani/laravel-array-destructuring.svg)](https://travis-ci.com/danilopolani/laravel-array-destructuring)

<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/danilopolani/laravel-array-destructuring">
    <img src="https://banners.beyondco.de/Laravel%20Array%20Destructuring.png?theme=light&packageManager=composer+require&packageName=danilopolani%2Flaravel-array-destructuring&pattern=dominos&style=style_1&description=Powerful+array+destructuring+for+Laravel&md=1&showWatermark=1&fontSize=100px&images=dots-horizontal">
  </a>
</p>


Extend `Arr` support adding a `destructure` method to have a powerful array destruction in Laravel.

<!-- TABLE OF CONTENTS -->
## Table of Contents
<ol>
  <li><a href="#installation">Installation</a></li>
  <li><a href="#usage">Usage</a></li>
  <li><a href="#changelog">Changelog</a></li>
  <li><a href="#contributing">Contributing</a></li>
  <li><a href="#testing">Testing</a></li>
  <li><a href="#security">Security</a></li>
  <li><a href="#credits">Credits</a></li>
  <li><a href="#license">License</a></li>
</ol>

<!-- GETTING STARTED -->
## Installation

The package supports `Laravel 8.x` and `PHP >= 7.4`.  

You can install the package via composer:

```bash
composer require danilopolani/laravel-array-destructuring
```

Thanks to the package auto-discovery feature, it will register itself automatically.

## Usage

> **Note**: if a key is not found its value will be `null`. If all the elements inside a group of keys are not found, the returned value will be an empty array `[]`. 

Basic destructuring for a key only

```php
$post = [
	'title' => 'Article 1',
	'slug' => 'article-1',
	'description' => 'Lorem ipsum',
	'tags' => ['foo', 'bar'],
	'gallery' => [
	    ['image' => 'image.jpg'],
	    ['image' => 'image2.jpg'],
	],
];

[$tags, $article] = Arr::destructure($post, 'tags');

dump($tags); // ['foo', 'bar']
dump($article) // ['title' => 'Article 1', 'slug' => 'article-1', ...] without tags

[$notFoundKey, $article] = Arr::destructure($post, 'notFoundKey');

dump($notFoundKey); // null
```

Destructuring with multiple keys

```php
$post = [
	'title' => 'Article 1',
	'slug' => 'article-1',
	'description' => 'Lorem ipsum',
	'tags' => ['foo', 'bar'],
	'gallery' => [
	    ['image' => 'image.jpg'],
	    ['image' => 'image2.jpg'],
	],
];

[$tags, $gallery, $article] = Arr::destructure($post, ['tags', 'gallery']);

dump($tags); // ['foo', 'bar']
dump($gallery); // [['image' => 'image.jpg'], ['image' => 'image2.jpg']]
dump($article) // ['title' => 'Article 1', 'slug' => 'article-1', 'description' => 'Lorem ipsum']
```

Destructuring with multiple grouped keys

```php
$post = [
	'title' => 'Article 1',
	'slug' => 'article-1',
	'description' => 'Lorem ipsum',
	'tags' => ['foo', 'bar'],
	'gallery' => [
	    ['image' => 'image.jpg'],
	    ['image' => 'image2.jpg'],
	],
];

[$slug, $meta, $article] = Arr::destructure($post, ['slug', ['tags', 'gallery']]);

dump($slug); // article-1
dump($meta); // ['tags' => ['foo', 'bar'], 'gallery' => ['image' => 'image.jpg'], ['image' => 'image2.jpg']]
dump($article) // ['title' => 'Article 1', 'description' => 'Lorem ipsum']

[$notFoundGroup, $article] = Arr::destructure($post, [['notFound1', 'notFound2']]);

dump($notFoundGroup); // []
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Testing

Clone the repository and just run

``` bash
composer test
```

With Docker (Windows):

```bash
docker run --rm -v %cd%:/app composer:latest bash -c "cd /app && composer install --ignore-platform-reqs && ./vendor/bin/phpunit"
```

With Docker (Linux/OSX):

```bash
docker run --rm -v $(pwd):/app composer:latest bash -c "cd /app && composer install && ./vendor/bin/phpunit"
```

## Security

If you discover any security related issues, please email danilo.polani@gmail.com instead of using the issue tracker.

## Credits

- [Danilo Polani](https://github.com/danilopolani)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

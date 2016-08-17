# Laravel Validation

This package provides validation utilities for Laravel.
The utilities are intended to be generic and expandable, allowing the validation system to suit many validation systems.

## Installation

Add the package using the composer command line interface:

```
composer install vector88/laravel-validation
```


Add the service provider to `config/app.php`:

```
[
	...

	'providers' => [
		...,
		Vector88\Laravel\Validation\ValidationServiceProvider::class,
		...,
	],

	'aliases' => [
		...,
		'Validation' => Vector88\Laravel\Validation\Facades\Validation::class,
		...,
	],

	...

]
```


## Usage



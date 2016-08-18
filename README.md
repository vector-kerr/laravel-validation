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


## Example

`App/Http/routes.php`
```
Route::get('/laravel', 'ValidationController@laravel' );
Route::get('/angular', 'ValidationController@angular' );
Route::get('/validator', 'ValidationController@validator' );
```



`App/Http/Controllers/ValidationController.php`
``` php
<?php

namespace App\Http\Controllers;

use Validator;
use Validation;

class ValidationController extends Controller
{
	
	protected $validation;
	
	public function __construct() {
		$this->validation =
			Validation::make()
				->field( 'name' )
					->isRequired()
					->isString()
					->hasMin( 4 )
					->hasMax( 16 )
				->field( 'age' )
					->isInteger()
					->hasMin( 0 )
					->hasMax( 120 );
	}
	
	public function angular() {
		return $this->validation
			->provide( 'angular' )
			->allAttributes();
	}
	
	public function laravel() {
		return $this->validation
			->provide( 'laravel' )
			->allAttributes();
	}
	
	public function validator() {
        $validator = Validator::make(
			[ 'name' => 'Jon', 'age' => 148.7 ],
			$this->validation->rules() );
		
		return $validator->errors();
	}
}
```

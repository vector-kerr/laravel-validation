<?php

namespace Vector88\Laravel\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider {
	
	public function register()
	{	
		$this->app->bind( 'LaravelValidation', function() { return new LaravelValidationService(); } );
		$this->app->bind( 'AngularValidation', function() { return AngularValidationService(); } );
		$this->app->tag( [ 'LaravelValidation', 'AngularValidation' ], 'ValidationServices' );
		$this->app->bind( 'Validation', function( $app ) { return new ValidationService( $app, $app->tagged( 'ValidationServices' ) ); } );
	}
	
}
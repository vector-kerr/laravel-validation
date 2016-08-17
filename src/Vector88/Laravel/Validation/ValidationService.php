<?php

namespace Vector88\Laravel\Validation;

class ValidationService {
	
	public function __construct( $app, $services ) {
		
	}
	
	public function make() {
		return new ValidationData( $this );
	}
	
}
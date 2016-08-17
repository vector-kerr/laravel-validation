<?php

namespace Vector88\Laravel\Validation;

class LaravelValidationService implements ValidationServiceContract {
	
	public function getKey() {
		return 'laravel';
	}
    
	public function setData( $data ) {
		throw new Exception( "Not Implemented" );
		return $this;
	}
	
}
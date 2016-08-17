<?php

namespace Vector88\Laravel\Validation;

class AngularValidationService implements ValidationServiceContract {
	
	public function getKey() {
		return 'angular';
	}
    
	public function setData( $data ) {
		throw new Exception( "Not Implemented" );
		return $this;
	}
	
}
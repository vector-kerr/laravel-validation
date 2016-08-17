<?php

namespace Vector88\Laravel\Validation;

class AngularValidationService implements ValidationServiceContract {
	
	protected $data;
	
	public function getKey() {
		return 'angular';
	}
    
	public function setData( $data ) {
		$this->data = $data;
		return $this;
	}
	
}
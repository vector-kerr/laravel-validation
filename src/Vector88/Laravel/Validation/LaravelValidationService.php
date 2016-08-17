<?php

namespace Vector88\Laravel\Validation;

class LaravelValidationService implements ValidationServiceContract {
	
	protected $data;
	
	public function getKey() {
		return 'laravel';
	}
    
	public function setData( $data ) {
		$this->data = $data;
		return $this;
	}
	
}
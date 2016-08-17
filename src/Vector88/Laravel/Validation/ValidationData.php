<?php

namespace Vector88\Laravel\Validation;

class ValidationData {
	
	protected $validaitonService;
	protected $rules;
	
	public function __construct( $validationService ) {
		$this->validationService = $validationService;
		$this->rules = [];
	}
	
	protected function _set( $key, $value = true ) {
		$this->rules[ $key ] = $value;
		return $this;
	}
	
	public function min( $value ) {
		return $this->_set( 'min', $value );
	}
	
	public function max( $value ) {
		return $this->_set( 'max', $value );
	}
	
	public function integer() {
		return $this->_set( 'integer' );
	}
	
	public function int() {
		return $this->integer();
	}
	
}
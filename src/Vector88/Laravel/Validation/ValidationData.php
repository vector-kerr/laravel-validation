<?php

namespace Vector88\Laravel\Validation;

class ValidationData {
	
	protected $validaitonService;
	protected $field;
	protected $rules;
	
	public function __construct( $validationService ) {
		$this->validationService = $validationService;
		$this->field = null;
		$this->rules = [];
	}
	
	public function field( $field ) {
		if( !isset( $this->rules[ $field ] ) ) {
			$this->rules[ $field ] = array();
		}
		$this->field = $field;
		return $this;
	}
	
	protected function _set( $key, $value = true ) {
		$this->rules[ $this->field ][ $key ] = $value;
		return $this;
	}
	
	public function required( $value ) {
		return $this->_set( 'required' );
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
	
	public function string() {
		return $this->set( 'string' );
	}
	
	public function str() {
		return $this->string();
	}
}
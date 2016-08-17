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
	
	/**
	 * Retrieve a concrete validation service contract using this set of validation rules
	 *
	 * @serviceKey string The type of validation service to retrieve for the given data
	 *
	 * @return ValidationServiceContract
	 */
	public function provide( $serviceKey ) {
		return $this->validationService->provide( $serviceKey, $this );
	}
	
	protected function _set( $key, $value = true ) {
		$this->rules[ $this->field ][ $key ] = $value;
		return $this;
	}
	
	public function required() {
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
		return $this->_set( 'string' );
	}
	
	public function str() {
		return $this->string();
	}
	
	public function email() {
		return $this->_set( 'email' );
	}
	
	public function unique( $table ) {
		return $this->_set( 'unique', $table );
	}
	
	public function confirmed() {
		return $this->_set( 'confirmed' );
	}
	
}
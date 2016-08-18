<?php

namespace Vector88\Laravel\Validation;

class ValidationData implements \ArrayAccess, \IteratorAggregate {
	
	protected $validaitonService;
	protected $field;
	protected $rules;
	
	protected $iteratorPosition;
	
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
	
	
	// BEGIN ArrayAccess IMPLEMENTATION
	
	public function offsetSet( $offset, $value ) {
		throw new Exception( "Invalid Operation" );
    }

    public function offsetExists( $offset ) {
        return isset( $this->rules[ $offset ] );
    }

    public function offsetUnset( $offset ) {
		throw new Exception( "Invalid Operation" );
    }

    public function offsetGet( $offset ) {
		if( !isset( $this->rules[ $offset ] ) ) {
			throw new Exception( "Invalid Array Offset" );
		}
		
		// Implicit clone
		$result = $this->rules[ $offset ];
		return $result;
    }
	
	// END ArrayAccess IMPLEMENTATION
	
	
	// BEGIN IteratorAggregate IMPLEMENTATION
	
	public function getIterator() {
		// Implicit clone
		$rules = $this->rules;
		return new \ArrayIterator( $rules );
	}
	
	// END IteratorAggregate IMPLEMENTATION
	
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
	
	public function rules() {
		return $this->validationService->rules( $this );
	}
	
	protected function _set( $key, $value = null ) {
		$this->rules[ $this->field ][ $key ] = $value;
		return $this;
	}
	
	
	
	
	public function isAccepted() {
		return $this->_set( 'accepted' );
	}
	
	public function isActiveUrl() {
		return $this->_set( 'active_url' );
	}
	
	public function after( $dateOrField ) {
		return $this->_set( 'after', $dateOrField );
	}
	
	public function isAlpha() {
		return $this->_set( 'alpha' );
	}
	
	public function isAlphaDash() {
		return $this->_set( 'alpha_dash' );
	}
	
	public function isAlphaNum() {
		return $this->_set( 'alpha_num' );
	}
	
	public function isArray() {
		return $this->_set( 'array' );
	}
	
	public function isBefore( $dateOrField ) {
		return $this->_set( 'before', $dateOrField );
	}
	
	public function isBetween( $min, $max ) {
		return $this->_set( 'between', [ $min, $max ] );
	}
	
	public function isBoolean() {
		return $this->_set( 'boolean' );
	}
	
	public function isConfirmed() {
		return $this->_set( 'confirmed' );
	}
	
	public function isDate() {
		return $this->_set( 'date' );
	}
	
	public function hasDateFormat( $format ) {
		return $this->_set( 'date_format', $format );
	}
	
	public function isDifferentTo( $field ) {
		return $this->_set( 'different', $field );
	}
	
	public function hasDigits( $value ) {
		return $this->_set( 'digits', $value );
	}
	
	public function hasDigitsBetween( $min, $max ) {
		return $this->_set( 'digits_between', [
			'min' => $min,
			'max' => $max,
		] );
	}
	
	public function hasDimensions( $minWidth = null, $minHeight = null, $maxWidth = null, $maxHeight = null, $width = null, $height = null, $ratio = null ) {
		return $this->_set( 'dimensions', [
			'min_width' => $minWidth,
			'min_height' => $minHeight,
			'max_width' => $maxWidth,
			'max_height' => $maxHeight,
			'width' => $width,
			'height' => $height,
			'ratio' => $ratio,
		] );
	}
	
	public function isDistinct() {
		return $this->_set( 'distinct' );
	}
	
	public function isEmail() {
		return $this->_set( 'email' );
	}
	
	public function exists( $table, $column ) {
		return $this->_set( 'exists', [
			'table' => $table,
			'column' => $column,
		] );
	}
	
	public function isFile() {
		return $this->_set( 'file' );
	}
	
	public function isFilled() {
		return $this->_set( 'filled' );
	}
	
	public function isImage() {
		return $this->_set( 'image' );
	}
	
	public function isIn( $values ) {
		return $this->_set( 'in', $values );
	}
	
	public function inArray( $anotherField ) {
		return $this->_set( 'in_array', $anotherField );
	}
	
	public function isInteger() {
		return $this->_set( 'integer' );
	}
	
	public function isIp() {
		return $this->_set( 'ip' );
	}
	
	public function isJson() {
		return $this->_set( 'json' );
	}
	
	public function hasMax( $value ) {
		return $this->_set( 'max', $value );
	}
	
	public function fileInMimetypes( $mimeTypes ) {
		return $this->_set( 'mimetypes', $mimeTypes );
	}
	
	public function fileInMimes( $mimes ) {
		return $this->_set( 'mimes', $mimes );
	}
	
	public function hasMin( $value ) {
		return $this->_set( 'min', $value );
	}
	
	public function notIn( $values ) {
		return $this->_set( 'not_in', $values );
	}
	
	public function isNumeric() {
		return $this->_set( 'numeric' );
	}
	
	public function isPresent() {
		return $this->_set( 'present' );
	}
	
	public function matchesRegex( $pattern ) {
		return $this->_set( 'regex', $pattern );
	}
	
	public function isRequired() {
		return $this->_set( 'required' );
	}
	
	public function isRequiredIf( $keyValues ) {
		return $this->_set( 'required_if', $keyValues );
	}
	
	public function isRequiredUnless( $keyValues ) {
		return $this->_set( 'required_unless', $keyValues );
	}
	
	public function isRequiredWith( $fields ) {
		return $this->_set( 'required_with', $fields );
	}
	
	public function isRequiredWithAll( $fields ) {
		return $this->_set( 'required_with_all', $fields );
	}
	
	public function isRequiredWithout( $fields ) {
		return $this->_set( 'required_without', $fields );
	}
	
	public function isRequiredWithoutAll( $fields ) {
		return $this->_set( 'required_without_all', $fields );
	}
	
	public function isSameAs( $field ) {
		return $this->_set( 'same', $field );
	}
	
	public function hasSize( $value ) {
		return $this->_set( 'size', $value );
	}
	
	public function sometimes() {
		return $this->_set( 'sometimes' );
	}
	
	public function isString() {
		return $this->_set( 'string' );
	}
	
	public function isTimezone() {
		return $this->_set( 'timezone' );
	}
	
	public function isUnique( $table, $column, $except = null, $idColumn = null, $whereKey = null, $whereValue = null ) {
		return $this->_set( 'unique', [
			'table' => $table,
			'column' => $column,
			'except' => $except,
			'id_column' => $idColumn,
			'where_key' => $whereKey,
			'where_value' => $whereValue,
		] );
	}
	
	public function isUrl() {
		return $this->_set( 'url' );
	}
	
}
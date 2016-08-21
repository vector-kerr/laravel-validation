<?php

namespace Vector88\Laravel\Validation;

class AngularValidationService implements ValidationServiceContract {
	
	protected $data;
	protected $currentFieldRules;
	protected $currentFieldAttributes;
	
	protected $messages = [
		'required' => 'The {{field}} field is required.',
		'string' => 'The {{field}} field must be a string.',	// TODO: use more human-understandable term than 'string'.
		'min' => 'The {{field}} field has a minimum length of {{value}} characters.',
		'max' => 'The {{field}} field has a maximum length of {{value}} characters.',
		'regex' => 'The {{field}} field doesn\'t look right.',	// TODO: surely, brain, you can do better than this.
	];
	
	public function getKey() {
		return 'angular';
	}
    
	public function setData( $data ) {
		$this->data = $data;
		return $this;
	}
	
	public function allAttributes() {
		$attributes = [];
		foreach( $this->data as $field => $unusedValue ) {
			$attributes[ $field ] = $this->attributes( $field );
		}
		return $attributes;
	}
	
	public function attributes( $field ) {
		$attributes = $this->rawAttributes( $field );
		$parts = [];
		foreach( $attributes as $k => $v ) {
			$parts[] = $k . ( null === $v ? "" : "=\"{$v}\"" );
		}
		return implode( " ", $parts );
	}
	
	public function rawAttributes( $field ) {
		$this->currentFieldRules = $this->data[ $field ];
		$this->currentFieldAttributes = [];
		
		$this
			->add( 'required', 'required' )
			->add( 'string', 'ng-string' )
			->add( 'min', 'ng-minlength', "{{value}}" )
			->add( 'max', 'ng-maxlength', "{{value}}" )
			->add( 'regex', 'ng-pattern', "{{value}}" );
		
		return $this->currentFieldAttributes;
	}
	
	protected function add( $rule, $attributeKey, $attributeValue = null ) {
		if( !array_key_exists( $rule, $this->currentFieldRules ) ) {
			return $this;
		}
		
		$value = (string)$this->currentFieldRules[ $rule ];
		
		if( null === $attributeValue ) {
			$this->currentFieldAttributes[ $attributeKey ] = null;
			return $this;
		}
		
		$expr = "/\{\{value\}\}/i";
		$result = preg_replace( $expr, $value, $attributeValue );
		$this->currentFieldAttributes[ $attributeKey ] = $result;
		return $this;
	}
	
	public function allMessages() {
		$messages = [];
		foreach( $this->data as $field => $unusedValue ) {
			$messages[ $field ] = $this->messages( $field );
		}
		return $messages;
	}
	
	public function messages( $field ) {
		$rules = $this->data[ $field ];
		$result = [];
		
		foreach( $rules as $rule => $ruleValues ) {
			if( array_key_exists( $rule, $this->messages ) ) {
				$ruleData = [ 'field' => $field ];
				$ruleData = array_merge( $ruleData, ( is_array( $ruleValues ) ? $ruleValues : [ 'value' => $ruleValues ] ) );
				$keys = array_map( function( $x ) { return "/\{\{{$x}\}\}/i"; }, array_keys( $ruleData ) );
				$subs = array_values( $ruleData );
				$message = $this->messages[ $rule ];
				$result[ $rule ] = preg_replace( $keys, $subs, $message );
			}
		}
		
		return $result;
	}
	
	public function allMessageElements() {
		$messageElements = [];
		foreach( $this->data as $field => $unusedValue ) {
			$messageElements[ $field ] = $this->messageElements( $field );
		}
		return $messageElements;
	}
	
	public function messageElements( $field ) {
		$messages = $this->messages( $field );
		$parts = [];
		foreach( $messages as $rule => $message ) {
			$parts[] = "<div ng-message=\"{$rule}\">{$message}</div>";
		}
		return $parts;
	}
	
}
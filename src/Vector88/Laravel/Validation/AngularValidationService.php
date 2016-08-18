<?php

namespace Vector88\Laravel\Validation;

class AngularValidationService implements ValidationServiceContract {
	
	protected $data;
	protected $currentFieldRules;
	protected $currentFieldAttributes;
	
	public function getKey() {
		return 'angular';
	}
    
	public function setData( $data ) {
		$this->data = $data;
		return $this;
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
	
	public function attributes( $field ) {
		$attributes = $this->rawAttributes( $field );
		$parts = [];
		foreach( $attributes as $k => $v ) {
			$parts[] = $k . ( null === $v ? "" : "=\"{$v}\"" );
		}
		return implode( " ", $parts );
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
	
}
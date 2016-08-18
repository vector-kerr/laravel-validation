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
	
	public function attributes( $field ) {
		$fieldRules = $this->data[ $field ];
		
		$parts = [];
		foreach( $fieldRules as $rule => $value ) {
			$parts[ $rule ] = $rule . ( ( null === $value && !is_array( $value ) ) ? "" : ":{$value}" );
		}
		
		// Handle specific cases
		
		if( array_key_exists( 'between', $fieldRules ) ) {
			$between = $fieldRules[ 'between' ];
			$parts[ 'between' ] = $between[ 'min' ] . "," . $between[ 'max' ];
		}
		
		if( array_key_exists( 'digits_between', $fieldRules ) ) {
			$digitsBetween = $fieldRules[ 'digits_between' ];
			$parts[ 'digits_between' ] = $digitsBetween[ 'min' ] . "," . $digitsBetween[ 'max' ];
		}
		
		if( array_key_exists( 'dimensions', $fieldRules ) ) {
			$values = [];
			$dimensions = $fieldRules[ 'dimensions' ];
			if( isset( $dimensions[ 'min_width' ] ) ) {
				$values[] = 'min_width=' . $dimensions[ 'min_width' ];
			}
			if( isset( $dimensions[ 'min_height' ] ) ) {
				$values[] = 'min_height=' . $dimensions[ 'min_height' ];
			}
			if( isset( $dimensions[ 'max_width' ] ) ) {
				$values[] = 'max_width=' . $dimensions[ 'max_width' ];
			}
			if( isset( $dimensions[ 'max_height' ] ) ) {
				$values[] = 'max_height=' . $dimensions[ 'max_height' ];
			}
			if( isset( $dimensions[ 'width' ] ) ) {
				$values[] = 'width=' . $dimensions[ 'width' ];
			}
			if( isset( $dimensions[ 'height' ] ) ) {
				$values[] = 'height=' . $dimensions[ 'height' ];
			}
			if( isset( $dimensions[ 'ratio' ] ) ) {
				$values[] = 'ratio=' . $dimensions[ 'ratio' ];
			}
			$parts[ 'dimensions' ] = implode( ",", $values );
		}
		
		if( array_key_exists( 'exists', $fieldRules ) ) {
			$exists = $fieldRules[ 'exists' ];
			$parts[ 'exists' ] = $exists[ 'table' ] . "," . $exists[ 'column' ];
		}
		
		if( array_key_exists( 'in', $fieldRules ) ) {
			$in = $fieldRules[ 'in' ];
			$parts[ 'in' ] = implode( ",", $in );
		}
		
		if( array_key_exists( 'mimetypes', $fieldRules ) ) {
			$mimetypes = $fieldRules[ 'mimetypes' ];
			$parts[ 'mimetypes' ] = implode( ",", $mimetypes );
		}
		
		if( array_key_exists( 'not_in', $fieldRules ) ) {
			$notIn = $fieldRules[ 'not_in' ];
			$parts[ 'not_in' ] = implode( ",", $notIn );
		}
		
		if( array_key_exists( 'required_if', $fieldRules ) ) {
			$requiredIf = $fieldRules[ 'required_if' ];
			$parts[ 'required_if' ] = implode( ",", $requiredIf );
		}
		
		if( array_key_exists( 'required_unless', $fieldRules ) ) {
			$requiredUnless = $fieldRules[ 'required_unless' ];
			$parts[ 'required_unless' ] = implode( ",", $requiredUnless );
		}
		
		if( array_key_exists( 'required_with', $fieldRules ) ) {
			$requiredWith = $fieldRules[ 'required_with' ];
			$parts[ 'required_with' ] = implode( ",", $requiredWith );
		}
		
		if( array_key_exists( 'required_with_all', $fieldRules ) ) {
			$requiredWithAll = $fieldRules[ 'required_with_all' ];
			$parts[ 'required_with_all' ] = implode( ",", $requiredWithAll );
		}
		
		if( array_key_exists( 'unique', $fieldRules ) ) {
			$unique = $fieldRules[ 'unique' ];
			
			$value = $unique[ 'table' ] . "," .
				$unique[ 'column' ] . "," .
				$unique[ 'except' ] . "," .
				( null === $unique[ 'id_column' ] ? $field : $unique[ 'id_column' ] );
			
			if( null !== $unique[ 'where_key' ] ) {
				$value .= "," . $unique[ 'where_key' ] . "," . $unique[ 'where_value' ];
			}
			
			$parts[ 'unique' ] = $value;
		}
		
		return implode( $parts, '|' );
	}
	
}
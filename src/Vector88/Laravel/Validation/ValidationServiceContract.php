<?php

namespace Vector88\Laravel\Validation;

interface ValidationServiceContract {
	
	/**
     * Get the key for this Validation Service
     *
     * @return string
     */
	public function getKey();
    
	/**
	 * Set the data for this Validation Service to work with
	 *
	 * @data ValidationData The validation data to use
	 *
	 * @return ValidationServiceContract
	 */
	public function setData( $data );
	
}
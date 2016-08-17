<?php

namespace Vector88\Laravel\Validation;

class ValidationService {
	
	protected $app;
	protected $services;
	
	public function __construct( $app, $services ) {
		$this->services = [];
		foreach( $services as $service ) {
			$this->services[ $service->getKey() ] = $service;
		}
	}
	
	public function make() {
		return new ValidationData( $this );
	}
	
	/**
	 * Retrieve a concrete validation service contract
	 *
	 * @serviceKey string The type of validation service to retrieve for the given data
	 * @data ValidationData The validataion rules data
	 *
	 * @return ValidationServiceContract
	 */
	public function provide( $serviceKey, $data ) {
		return $this->services[ $serviceKey ]->setData( $data );
	}
	
}
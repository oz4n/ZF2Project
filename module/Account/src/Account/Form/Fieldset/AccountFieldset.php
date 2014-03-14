<?php

namespace Account\Form\Fieldset;

use ORM\Entity\Account;
use ORM\Registry\ORMRegistry;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

class AccountFieldset extends Fieldset implements InputFilterProviderInterface {
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ( "account" );
		$em = ORMRegistry::get ( 'entityManager' );
		$this->setHydrator ( new DoctrineEntity ( $em ) )->setObject ( new Account () );
		$this->add ( [ 
				"name" => "id",
				"attributes" => [ 
						"type" => "hidden" 
				] 
		] );
		
		$this->add ( [ 
				"name" => "username",
				"attributes" => [ 
						"type" => "text",
						"class" => "form-control" 
				] 
		] );
		$this->add ( [ 
				"name" => "password",
				"attributes" => [ 
						"type" => "password",
						"class" => "form-control" 
				] 
		] );
		
		$this->add ( [ 
				"name" => "salt",
				"attributes" => [ 
						"type" => "text",
						"class" => "form-control" 
				] 
		] );
		
		$this->add ( [ 
				"name" => "email",
				"attributes" => [ 
						"type" => "email",
						"class" => "form-control" 
				] 
		] );
	}
	
	/**
	 * Define InputFilterSpecifications
	 *
	 * @access public
	 * @return array
	 */
	public function getInputFilterSpecification() {
		return [ 
				"username" => [ 
						"required" => true,
						"filters" => [ 
								[ 
										"name" => "StringTrim" 
								],
								[ 
										"name" => "StripTags" 
								] 
						],
						"properties" => [ 
								"required" => true 
						] 
				],
				"password" => [ 
						"required" => true,
						"filters" => [ 
								[ 
										"name" => "StringTrim" 
								] 
						],
						"properties" => [ 
								"required" => true 
						] 
				],
				"salt" => [ 
						"required" => true,
						"filters" => [ 
								[ 
										"name" => "StringTrim" 
								] 
						],
						"properties" => [ 
								"required" => true 
						] 
				],
				"email" => [ 
						"required" => true,
						"filters" => [ 
								[ 
										"name" => "StringTrim" 
								] 
						],
						"properties" => [ 
								"required" => true 
						] 
				] 
		];
	}
}

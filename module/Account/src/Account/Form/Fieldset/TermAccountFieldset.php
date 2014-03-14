<?php

namespace Account\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use ORM\Registry\ORMRegistry;
use ORM\Entity\TermAccount;

class TermAccountFieldset extends Fieldset implements InputFilterProviderInterface {
	/**
	 */
	public function __construct() {
		parent::__construct ( "termaccount" );
		$em = ORMRegistry::get ( "entityManager" );
		$this->setHydrator ( new DoctrineEntity ( $em ) )->setObject ( new TermAccount () );
		$this->add ( [ 
				"name" => "id",
				"attributes" => [ 
						"type" => "hidden" 
				] 
		] );
		
		$this->add ( [ 
				"name" => "termKey",
				"attributes" => [ 
						"type" => "text",
						"class" => "form-control" 
				] 
		] );
		
		$this->add ( [ 
				"name" => "value",
				"attributes" => [ 
						"type" => "text",
						"class" => "form-control" 
				] 
		] );
		
		$this->add ( [ 
				'type' => 'Zend\Form\Element\Select',
				"name" => "autoload",
				"attributes" => [ 
						"class" => "form-control" 
				],
				"options" => [ 
						"value_options" => [ 
								"YES" => "Yes",
								"NO" => "No" 
						] 
				] 
		] );
		
// 		$this->add ( [ 
// 				'type' => 'Zend\Form\Element\Select',
// 				"name" => "account",
// 				"attributes" => [ 
// 						"class" => "form-control" 
// 				],
// 				"options" => [ 
// 						"value_options" => [ 
// 								"2" => "2",
// 								"3" => "3" 
// 						] 
// 				] 
// 		] );
		
		$this->add ( [ 
				'type' => 'DoctrineModule\Form\Element\ObjectSelect',
				'name' => 'account',
				"attributes" => [ 
						"class" => "form-control" ,						
				],
				'options' => [ 
						'object_manager' => $em,
						'target_class' => 'ORM\Entity\Account',
						'property' => 'username' 
				] 
		] );
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
	 */
	public function getInputFilterSpecification() {
		return [ 
				"termKey" => [ 
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
				"value" => [ 
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
				"autoload" => [ 
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
				"account" => [ 
						"required" => true,
// 						"filters" => [ 
// 								[ 
// 										"name" => "IntigerTrim" 
// 								],
// 								[ 
// 										"name" => "StripTags" 
// 								] 
// 						],
						"properties" => [ 
								"required" => true 
						] 
				] 
		];
	}
}
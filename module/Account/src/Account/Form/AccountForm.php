<?php

namespace Account\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;

class AccountForm extends Form {
	public function __construct() {
		parent::__construct ( 'account' );
		$this->setAttribute ( 'method', 'post' )->setHydrator ( new ClassMethods () )->setInputFilter ( new InputFilter () );		
		$this->setAttribute ( 'role', 'form' );
		$this->setAttribute ( 'class', 'form-horizontal' );
		
		$this->add ( [ 
				'type' => 'Account\Form\Fieldset\AccountFieldset',
				'options' => [ 
						'use_as_base_fieldset' => true 
				] 
		] );
		
		$this->add ( [ 
				'name' => 'security',
				'type' => 'Zend\Form\Element\Csrf' 
		] );
		
		$this->add ( [ 
				'name' => 'submit',
				'attributes' => [ 
						'type' => 'submit',
						'value' => 'Save',
						'class' => 'btn btn-default' 
				] 
		] );
		
		$this->setValidationGroup ( [ 
				'security',
				'account' => [ 
						'username',						
						'password', 
						'salt',
						'email'
				] 
		] );
	}
} 
<?php


namespace Account\Form;

use Zend\Form\Form;

class AccountForm extends Form
{
	public function __construct()
	{
		parent::__construct('Account');
		$this->setAttribute('method', 'post');
		$this->setAttribute('role', 'form');
		$this->setAttribute('class', 'form-horizontal');
		$this->add(
			 [
				 'name' => 'username',
				 'attributes' => [
					 'type' => 'text',
					 'class' => 'form-controll'
				 ],
			 ]
		);
		$this->add(
			 [
				 'name' => 'password',
				 'attributes' => [
					 'type' => 'password',
					 'class' => 'form-controll'
				 ]
			 ]
		);

		$this->add(
			 [
				 'name' => 'salt',
				 'attributes' => [
					 'type' => 'text',
					 'class' => 'form-controll'
				 ]
			 ]
		);

		$this->add(
			[
				'name' => 'email',
				'type' =>  'Zend\Form\Element\Email',
				'attributes' => [
					'class' => 'form-controll'
				]
			]
		);

		$this->add(
			 [
				 'name' => 'submit',
				 'attributes' => [
					 'type' => 'submit',
					 'value' => 'Save',
					 'class' => 'btn btn-default'
				 ]
			 ]
		);
	}

} 
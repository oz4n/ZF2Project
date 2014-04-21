<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

/**
 * Description of UserForm
 *
 * @author melengo
 */
class UserForm extends Form
{

    public function __construct()
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');
        $this->setHydrator(new ClassMethods());
        $this->setInputFilter(new InputFilter());
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form-horizontal');

        /**
         * User Form Fieldset
         */
        $this->add([
            'type' => 'User\Form\Fieldset\UserFieldset',
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);

        /**
         * form user scurity
         */
        $this->add([
            'name' => 'security',
            'type' => 'Zend\Form\Element\Csrf'
        ]);

        /**
         * button submit
         */
        $this->add([
            'name' => 'button',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Save',
                'class' => 'btn btn-default'
            ]
        ]);

        /**
         * Form User Falidator
         */
        $this->setValidationGroup([
            'security',
            'user' => [
                'role',
                'userName',
                'firstName',
                'lastName',
                'displayName',
                'question',
                'answer',
                'password',
                'email'
            ]
        ]);
    }

}

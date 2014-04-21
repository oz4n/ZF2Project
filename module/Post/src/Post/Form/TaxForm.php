<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

/**
 * Description of TaxForm
 *
 * @author melengo
 */
class TaxForm extends Form
{

    public function __construct()
    {
        parent::__construct('tax');
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');

        $this->setHydrator(new ClassMethods());
        $this->setInputFilter(new InputFilter());
        $this->addFieldset();
        $this->addSecurity();
        $this->addButton();
        $this->validationGroup();
    }

    protected function addFieldset()
    {

        $this->add([
            'type' => 'Post\Form\Fieldset\TaxFieldset',
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);
    }

    protected function addSecurity()
    {
        $this->add([
            'name' => 'security',
            'type' => 'Zend\Form\Element\Csrf'
        ]);
    }

    protected function addButton()
    {
        $this->add([
            'name' => 'button',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Save',
                'class' => 'btn btn-primary'
            ]
        ]);
    }

    protected function validationGroup()
    {
        $this->setValidationGroup([
            'security',
            'tax' => [                
                'parent',
                'term',
                'name',
                'slug',
                'description',
                'status'
            ]
        ]);
    }

}

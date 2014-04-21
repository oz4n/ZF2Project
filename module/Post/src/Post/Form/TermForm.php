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
 * Description of TermForm
 *
 * @author melengo
 */
class TermForm extends Form
{

    public function __construct()
    {
        parent::__construct('term');
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form-horizontal');

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
            'type' => 'Post\Form\Fieldset\TermFieldset',
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
                'class' => 'btn btn-default'
            ]
        ]);
    }

    protected function validationGroup()
    {
        $this->setValidationGroup([
            'security',
            'term' => [
                'name'
            ]
        ]);
    }

}

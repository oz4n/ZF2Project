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
 * Description of SearchForm
 *
 * @author melengo
 */
class SearchForm extends Form
{

    public function __construct()
    {
        parent::__construct('search');
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setHydrator(new ClassMethods());
        $this->setInputFilter(new InputFilter());

        $this->add([
            'type' => 'Post\Form\Fieldset\SearchFieldset',
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);

        $this->add([
            'name' => 'security',
            'type' => 'Zend\Form\Element\Csrf'
        ]);

        $this->add([
            'name' => 'button',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Search',
                'class' => 'btn btn-primary"'
            ]
        ]);

        $this->setValidationGroup([
            'security',
            'search' => [
                'keyword'
            ]
        ]);
    }

}

<?php
namespace Account\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\InputFilter\InputFilter;

class TermAccountForm extends Form
{

    public function __construct()
    {
        parent::__construct('termaccount');
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form-horizontal');
        
        $this->setHydrator(new ClassMethodsHydrator());
        $this->setInputFilter(new InputFilter());
        
        $this->add([
            'type' => 'Account\Form\Fieldset\TermAccountFieldset',
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);
        
        $this->add([
            'name' => 'security',
            'type' => 'Zend\Form\Element\Csrf'
        ]);
        
        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Save',
                'class' => 'btn btn-default'
            ]
        ]);
        
        $this->setValidationGroup([
            'security',
            'termaccount' => [
                'termKey',
                'value',
                'autoload',
                'account'
            ]
        ]);
    }
}

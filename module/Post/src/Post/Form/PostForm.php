<?php
namespace Post\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilter;

class PostForm extends Form
{

    public function __construct()
    {
        parent::__construct('post');
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form-horizontal');
        
        $this->setHydrator(new ClassMethods());
        $this->setInputFilter(new InputFilter());
        
        $this->add([
            'type' => 'Post\Form\Fieldset\PostFieldset',
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
                'value' => 'Save',
                'class' => 'btn btn-default'
            ]
        ]);
        
        $this->setValidationGroup([
            'security',
            'post' => [
                'title',
                'content',
//                 'slug',
                'status',
                'commentStatus',
                'user'            
            ]
        ]);
    }
}

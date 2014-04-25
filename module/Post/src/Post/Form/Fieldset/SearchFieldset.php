<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Description of SearchFieldset
 *
 * @author melengo
 */
class SearchFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('search');
        $this->addSearch();
    }
    
    public function addSearch()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'keyword',            
        ));
    }

    public function getInputFilterSpecification()
    {
        return [];
    }

}

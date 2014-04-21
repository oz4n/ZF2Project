<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use ORM\Registry\Registry;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use ORM\Entity\Terminologi;

/**
 * Description of TermFieldset
 *
 * @author melengo
 */
class TermFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('term');
        $em = Registry::get('entityManager');
        $this->setHydrator(new DoctrineEntity($em))->setObject(new Terminologi());
//        $this->addId();
        $this->addName();
    }

    protected function addId()
    {
        $this->add([
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden'
        ]);
    }

    protected function addName()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'name',
            "attributes" => [
                "class" => "col-xs-10 col-sm-5"
            ]
        ));
    }

    public function getInputFilterSpecification()
    {
        return [
            'name' => [
                'required' => true,
                'filters' => [
                    [
                        'name' => 'StringTrim'
                    ],
                    [
                        'name' => 'StripTags'
                    ]
                ],
                'properties' => [
                    'required' => true
                ],
            ],
        ];
    }

}

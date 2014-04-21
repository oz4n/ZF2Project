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
use ORM\Entity\Taxonomy;

/**
 * Description of CategoryFieldset
 *
 * @author melengo
 */
class TaxFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('tax');
        $em = Registry::get('entityManager');
        $this->setHydrator(new DoctrineEntity($em))->setObject(new Taxonomy());
        $this->addId();
        $this->addParent($em);
        $this->addTerm($em);
        $this->addName();
        $this->addSlug();
        $this->addDescription();
        $this->addStatus();
    }

    protected function addId()
    {
        $this->add([
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden'
        ]);
    }

    public function addParent($em)
    {

        $this->add([
            'name' => 'parent',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => [
                'class' => 'form-control',
                'required' => false,
                'id' => 'paren-category'
            ],
            'options' => [
                'empty_option' => 'Choose Parent',
                'object_manager' => $em,
                'target_class' => 'ORM\Entity\Taxonomy',
                'property' => 'name',
                'value' => 'id',
                'is_method' => true,
                'find_method' => [
                    'name' => 'findBy',
                    'params' => [
                        'criteria' => [
                            'term' => '1',
                        ],
                        'orderBy' => [
                            'root' => 'ASC',
                            'lft' => 'ASC'
                        ]
                    ]
                ]
            ],
        ]);
    }

    public function addTerm($em)
    {
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'term',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'object_manager' => $em,
                'target_class' => 'ORM\Entity\Terminologi',
                'property' => 'name'
            ]
        ]);
    }

    protected function addName()
    {
        $this->add([
            'name' => 'name',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
    }

    protected function addSlug()
    {
        $this->add([
            'name' => 'slug',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
    }

    protected function addDescription()
    {
        $this->add([
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'description',
            'attributes' => [
                'class' => 'form-control',
                'rows' => '5'
            ]
        ]);
    }

    protected function addStatus()
    {
        $this->add([
            'name' => 'status',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options' => [
                'value_options' => [
                    'Publish' => "Publish",
                    'Draft' => 'Draft'
                ]
            ]
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'name' => [
                'required' => true
            ],
            'parent' => [
                'required' => false
            ],
        ];
    }

}

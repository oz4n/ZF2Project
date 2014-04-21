<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use ORM\Registry\Registry;
use ORM\Entity\User;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

/**
 * Description of UserFieldset
 *
 * @author melengo
 */
class UserFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('user');
        $em = Registry::get('entityManager');
        $this->setHydrator(new DoctrineEntity($em))->setObject(new User());

        /**
         * Entity id
         */
        $this->add([
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden'
        ]);

        /**
         * Entity role_id
         */
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'role',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options' => [
                'object_manager' => $em,
                'target_class' => 'ORM\Entity\Role',
                'property' => 'name'
            ]
        ]);

        /**
         * Entity user_name
         */
        $this->add([
            'name' => 'userName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);

        /**
         * Entity display_name
         */
        $this->add([
            'name' => 'displayName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);

        /**
         * Entity first_name
         */
        $this->add([
            'name' => 'firstName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);

        /**
         * Entity last_name
         */
        $this->add([
            'name' => 'lastName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);

        /**
         * Entity middel_name
         */
        $this->add([
            'name' => 'middelName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);

        /**
         * Entity full_name
         */
        $this->add([
            'name' => 'fullName',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);

        /**
         * password
         */
        $this->add([
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        /**
         * email
         */
        $this->add([
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        /**
         * Entity Question
         */
        $this->add([
            'name' => 'question',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);

        /**
         * answer
         */
        $this->add([
            'name' => 'answer',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'form-control'
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            'userName' => [
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
            'firstName' => [
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
                ]
            ],
            'lastName' => [
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
                ]
            ],
            'displayName' => [
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
                ]
            ],
            'question' => [
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
                ]
            ],
            'answer' => [
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
                ]
            ],
            'password' => [
                'required' => true,
                'filters' => [
                    [
                        'name' => 'StringTrim'
                    ]
                ],
                'properties' => [
                    'required' => true
                ]
            ],
            'email' => [
                'required' => true,
                'filters' => [
                    [
                        'name' => 'StringTrim'
                    ]
                ],
                'properties' => [
                    'required' => true
                ]
            ]
        ];
    }

}

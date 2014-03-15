<?php
namespace Account\Form\Fieldset;

use ORM\Entity\Account;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineEntityHydrator;
use ORM\Registry\Registry;


class AccountFieldset extends Fieldset implements InputFilterProviderInterface
{

   
    /**
     */
    public function __construct()
    {
        parent::__construct('account');
        $em = Registry::get('entityManager');        
        $this->setHydrator(new DoctrineEntityHydrator($em))->setObject(new Account());
        $this->add([
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden'
        ]);
        
        $this->add([
            'name' => 'username',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [               
                'class' => 'form-control'
            ],           
        ]);
        $this->add([
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => [                
                'class' => 'form-control'
            ]
        ]);
        
        $this->add([
            'name' => 'salt',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [               
                'class' => 'form-control'
            ]
        ]);
        
        $this->add([
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => [              
                'class' => 'form-control'
            ]
        ]);
    }

    /**
     * Define InputFilterSpecifications
     *
     * @access public
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'username' => [
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
            'salt' => [
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

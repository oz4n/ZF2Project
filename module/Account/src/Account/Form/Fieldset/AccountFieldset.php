<?php
namespace Account\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity as DoctrineEntityHydrator;
use ORM\Registry\Registry;
use ORM\Entity\User;


class AccountFieldset extends Fieldset implements InputFilterProviderInterface
{

   
    /**
     */
    public function __construct()
    {
        parent::__construct('account');
        $em = Registry::get('entityManager');        
        $this->setHydrator(new DoctrineEntityHydrator($em))->setObject(new User());
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

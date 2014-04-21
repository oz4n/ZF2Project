<?php
namespace Post\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use ORM\Registry\Registry;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use ORM\Entity\Post;

class PostFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct()
    {
        parent::__construct('post');
        $em = Registry::get('entityManager');
        $this->setHydrator(new DoctrineEntity($em))->setObject(new Post());
        
        $this->add([
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden'
        ]);
        
        $this->add([
            'name' => 'title',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => [
                'class' => 'col-xs-10 col-sm-5'
            ]
        ]);
        
        $this->add([
            'name' => 'content',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => [
                'class' => 'col-xs-10 col-sm-5'
            ]
        ]);
        
//         $this->add([
//             'name' => 'slug',
//             'type' => 'Zend\Form\Element\Text',
//             'attributes' => [
//                 'class' => 'form-class'
//             ]
//         ]);
        
//         $this->add([
//             'name' => 'createTime',
//             'type' => 'Zend\Form\Element\DateTime',
//             'options' => [
//                   'format' => 'd/m/Y H:i'
//             ],
//             'attributes' => [
            
//                 'class' => 'form-class',              
//             ]
//         ]);
        
//         $this->add([
//             'name' => 'updateTime',
//             'type' => 'Zend\Form\Element\DateTime',
//             'options' => [
//                 'format' => 'd/m/Y H:i'
//             ],
//             'attributes' => [
//                 'class' => 'form-class'
//             ]
//         ]);
        
        $this->add([
            'name' => 'status',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => [
                'class' => 'col-xs-10 col-sm-5'
            ],
            "options" => [
                "value_options" => [
                    "P" => "Publish",
                    "D" => "Draft"
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'commentStatus',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => [
                'class' => 'col-xs-10 col-sm-5'
            ],
            "options" => [
                "value_options" => [
                    "E" => "Enable",
                    "D" => "Disable"
                ]
            ]
        ]);
        
        $this->add([
            'name' => 'postStatus',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => [
                'class' => 'col-xs-10 col-sm-5'
            ],
            "options" => [
                "value_options" => [
                    "Info" => "Info",
                    "Page" => "Page"
                ]
            ]
        ]);
        
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'parent',
            "attributes" => [
                "class" => "col-xs-10 col-sm-5"
            ],
            'options' => [
                'object_manager' => $em,
                'target_class' => 'ORM\Entity\Post',
                'property' => 'title'
            ]
        ]);
        
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'user',
            "attributes" => [
                "class" => "col-xs-10 col-sm-5"
            ],
            'options' => [
                'object_manager' => $em,
                'target_class' => 'ORM\Entity\User',
                'property' => 'userName'
            ]
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [];
    }
}
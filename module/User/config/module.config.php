<?php
return [
    'controllers' => [
        'invokables' => [
            'User\Controller\User' => 'User\Controller\UserController'
        ]
    ],
    'router' => [
        'routes' => [
            'user' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/user[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'User\Controller\User',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'user' => __DIR__ . '/../view'
        ]
    ],
    
    'doctrine' => [
        'driver' => [
            'user_orm_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/User/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'User\Entity' => 'user_orm_driver'
                ]
            ]
        ]
    ]
];
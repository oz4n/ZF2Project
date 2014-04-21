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
                'type' => 'Literal',
                'options' => [
                    'route' => '/dashboard/user',
                    'defaults' => [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'User',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                '__NAMESPACE__' => 'User\Controller',
                                'controller' => 'User',
                                'action' => 'add'
                            ]
                        ]
                    ],
                    'edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/edit[/][:id]',
                            'defaults' => [
                                '__NAMESPACE__' => 'User\Controller',
                                'controller' => 'User',
                                'action' => 'edit',
                                'id' => '[0-9]+'
                            ]
                        ]
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete[/][:id]',
                            'defaults' => [
                                '__NAMESPACE__' => 'User\Controller',
                                'controller' => 'User',
                                'action' => 'delete',
                                'id' => '[0-9]+'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'user' => __DIR__ . '/../view'
        ]
    ]
];

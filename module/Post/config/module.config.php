<?php
return [
    'controllers' => [
        'invokables' => [
            'Post\Controller\Post' => 'Post\Controller\PostController'
        ]
    ],
    'router' => [
        'routes' => [
            'post' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/dashboard/post[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'Post\Controller\Post',
                        'action' => 'index'
                    ]
                ]
            ],          
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'post' => __DIR__ . '/../view'
        ]
    ]
];
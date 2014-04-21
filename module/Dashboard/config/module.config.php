<?php
return [
    'controllers' => [
        'invokables' => [
            'Dashboard\Controller\Dashboard' => 'Dashboard\Controller\DashboardController'
        ]
    ],
    
    'router' => [
        'routes' => [
            'dashboard' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/dashboard',
                    'defaults' => [
                        '__NAMESPACE__' => 'Dashboard\Controller',
                        'controller' => 'Dashboard',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
            ]
        ]
        
    ],
    'view_manager' => [
        'template_path_stack' => [
            'dashboard' => __DIR__ . '/../view'
        ]
    ],
    'translator' => array(
        'locale' => 'id_ID',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    )
];
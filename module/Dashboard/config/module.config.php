<?php

return [
    'controllers' => [
        'invokables' => [
            'Dashboard\Controller\Dashboard' => 'Dashboard\Controller\DashboardController',          
        ]
    ],
    'router' => [
        'routes' => [
            'dashboard' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/dashboard[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'Dashboard\Controller\Dashboard',
                        'action' => 'index'
                    ]
                ]
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
                'pattern' => '%s.mo',
            ),
        ),
    ),
];
<?php

return [
    'controllers' => [
        'invokables' => [
            'Site\Controller\Site' => 'Site\Controller\SiteController',          
        ]
    ],
    'router' => [
        'routes' => [
            'site' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/site[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'Site\Controller\Site',
                        'action' => 'index'
                    ]
                ]
            ]           
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'site' => __DIR__ . '/../view'
        ]
    ],
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'module_layouts' => array(
        'Site' => 'layout/layout.phtml',        
    ),
];
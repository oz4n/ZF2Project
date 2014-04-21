<?php

return [
    'controllers' => [
        'invokables' => [
            'Page\Controller\Page' => 'Page\Controller\PageController',            
        ]
    ],
    'router' => [
        'routes' => [            
            'page' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/dashboard/page[/][:action][/:id]',
                    'constraints' => [                       
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'Page\Controller\Page',
                        'action' => 'index',
                    ]
                ]
            ],
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'page' => __DIR__ . '/../view'
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
];
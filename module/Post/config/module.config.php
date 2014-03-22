<?php
return [
    'controllers' => [
        'invokables' => [
            'Post\Controller\Post' => 'Post\Controller\PostController',
            'Post\Controller\Category' => 'Post\Controller\CategoryController',
            'Post\Controller\Tag' => 'Post\Controller\TagController',
            'Post\Controller\Comment' => 'Post\Controller\CommentController',
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
            'category' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/dashboard/post/category[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'Post\Controller\Category',
                        'action' => 'index'
                    ]
                ]
            ],
            'tag' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/dashboard/post/tag[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'Post\Controller\Tag',
                        'action' => 'index'
                    ]
                ]
            ],
            'comment' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/dashboard/post/comment[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'Post\Controller\Comment',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'post' => __DIR__ . '/../view'
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
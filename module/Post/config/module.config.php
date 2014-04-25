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
                'type' => 'Literal',
                'options' => [
                    'route' => '/dashboard/post',
                    'defaults' => [
                        '__NAMESPACE__' => 'Post\Controller',
                        'controller' => 'Post',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'post_add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Post',
                                'action' => 'add'
                            ]
                        ]
                    ],
                    'post_edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/edit[/][:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Post',
                                'action' => 'edit',
                            ]
                        ]
                    ],
                    'post_delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete[/][:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Post',
                                'action' => 'delete',
                            ]
                        ]
                    ],
                    /**
                     * Categories Route
                     */
                    'post_category' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/categories',
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Category',
                                'action' => 'index',
                            ]
                        ]
                    ],
                    'post_category_pagintaion' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/categories/[page:page]',
                            'constraints' => [
                                'page' => '[0-9]+',                                
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Category',
                                'action' => 'index',
                            ]
                        ]
                    ],
                    'post_category_add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/category/add',
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Category',
                                'action' => 'add',
                            ]
                        ]
                    ],
                    'post_category_edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/category/edit[/][:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Category',
                                'action' => 'edit'
                            ]
                        ]
                    ],
                    'post_category_pagintaion_edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/category/edit[/][:id][/page/:page]',
                            'constraints' => [
                                'id' => '[0-9]+',
                                'page' => '[0-9]+',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Category',
                                'action' => 'edit',
                            ]
                        ]
                    ],
                    'post_category_pagintaion_add' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/category/add[/page/:page]',
                            'constraints' => [
                                'page' => '[0-9]+',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Category',
                                'action' => 'add',
                            ]
                        ]
                    ],
//                    'post_category_pagintaion_edit_serch' => [
//                        'type' => 'Segment',
//                        'options' => [
//                            'route' => '/categories/edit[/][:id][/page/:page]',
//                            'constraints' => [
//                                'id' => '[0-9]+',
//                                'page' => '[0-9]+',                                
//                            ],
//                            'defaults' => [
//                                '__NAMESPACE__' => 'Post\Controller',
//                                'controller' => 'Category',
//                                'action' => 'edit',
//                            ]
//                        ]
//                    ],
//                    
//                    'post_category_pagintaion_add' => [
//                        'type' => 'Segment',
//                        'options' => [
//                            'route' => '/categories/add[/page/:page]',
//                            'constraints' => [                              
//                                'page' => '[0-9]+',                                
//                            ],
//                            'defaults' => [
//                                '__NAMESPACE__' => 'Post\Controller',
//                                'controller' => 'Category',
//                                'action' => 'add',
//                            ]
//                        ]
//                    ],
                    'post_category_delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/category/delete[/][:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Category',
                                'action' => 'delete',
                            ]
                        ]
                    ],
                    /**
                     * Tags route
                     */
                    'post_tag' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/tags',
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Tag',
                                'action' => 'index',
                            ]
                        ]
                    ],
                    'post_tag_add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/tag/add',
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Tag',
                                'action' => 'add',
                            ]
                        ]
                    ],
                    'post_tag_edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/tag/edit[/][:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Tags',
                                'action' => 'edit',
                            ]
                        ]
                    ],
                    'post_tag_delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/tag/delete[/][:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Tag',
                                'action' => 'delete'
                            ]
                        ]
                    ],
                    /**
                     * Comments route
                     */
                    'post_comment' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/comments',
                            'defaults' => [
                                '__NAMESPACE__' => 'Post\Controller',
                                'controller' => 'Comment',
                                'action' => 'index',
                            ]
                        ]
                    ]
                ],
            ],
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'post' => __DIR__ . '/../view'
        ]
    ],
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    )
];

<?php
return array(
    'module_layouts' => array(
        'ZfcUser' => 'layout/login.phtml',
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'zfcuser' => __DIR__ . '/../view',
        ),
    ),
    
//     'view_manager' => array(
//         'display_not_found_reason' => true,
//         'display_exceptions' => true,
//         'doctype' => 'HTML5',
//         'not_found_template' => 'error/404',
//         'exception_template' => 'error/index',
//         'template_map' => array(
//             'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
//             'setting/index/index' => __DIR__ . '/../view/setting/index/index.phtml',
//             'error/404' => __DIR__ . '/../view/error/404.phtml',
//             'error/index' => __DIR__ . '/../view/error/index.phtml'
//         ),
//         'template_path_stack' => array(
//             __DIR__ . '/../view'
//         )
//     ),
    'controllers' => array(
        'invokables' => array(
            'zfcuser' => 'ZfcUser\Controller\UserController',
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
            'zfcuser_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ),
    ),
    'router' => array(
        'routes' => array(
            'zfcuser' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        'controller' => 'zfcuser',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'login' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/login',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'login',
                            ),
                        ),
                    ),
                    'authenticate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/authenticate',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'authenticate',
                            ),
                        ),
                    ),
                    'logout' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/logout',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'logout',
                            ),
                        ),
                    ),
                    'register' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/register',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'register',
                            ),
                        ),
                    ),
                    'changepassword' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/change-password',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action'     => 'changepassword',
                            ),
                        ),                        
                    ),
                    'changeemail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/change-email',
                            'defaults' => array(
                                'controller' => 'zfcuser',
                                'action' => 'changeemail',
                            ),
                        ),                        
                    ),
                ),
            ),
        ),
    ),
);

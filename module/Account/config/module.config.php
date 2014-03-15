<?php
return [ 
		'controllers' => [ 
				'invokables' => [ 
						'Account\Controller\Account' => 'Account\Controller\AccountController',
						'Account\Controller\TermAccount' => 'Account\Controller\TermAccountController' 
				] 
		],
		
		'router' => [
        'routes' => [
            'account' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/dashboard/account[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'Account\Controller\Account',
                        'action' => 'index'
                    ]
                ]
            ],
            'termaccount' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/dashboard/account/term[/][:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'Account\Controller\TermAccount',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'account' => __DIR__ . '/../view'
        ]
    ] 
];
<?php
return [
	'controllers' => [
		'invokables' => [
			'Account\Controller\Account' => 'Account\Controller\IndexController',
		]
	],
	// The following section is new and should be added to your file
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
			]
		]
	],
	'view_manager' => [
		'template_path_stack' => [
			'account' => __DIR__ . '/../view',
		]
	]
];
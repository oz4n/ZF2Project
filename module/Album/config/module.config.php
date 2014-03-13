<?php
return array(
//	'doctrine' => array(
//		'driver' => array(
//			'Album_driver' => array(
//				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
//				'cache' => 'array',
//				'paths' => array(__DIR__ . '/../src/Album/Entity')
//			),
//			'orm_default' => array(
//				'drivers' => array(
//					'Album\Entity' => 'Album_driver'
//				),
//			),
//		),
//	),
	'controllers' => array(
		'invokables' => array(
			'Album\Controller\Album' => 'Album\Controller\AlbumController',
		),
	),
	// The following section is new and should be added to your file
	'router' => array(
		'routes' => array(
			'album' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/dashboard/album[/][:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Album\Controller\Album',
						'action' => 'index',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'album' => __DIR__ . '/../view',
		),
	),
);
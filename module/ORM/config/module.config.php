<?php
return array(
	'doctrine' => array(
		'driver' => array(
			'orm_driver' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/ORM/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
					'ORM\Entity' => 'orm_driver'
				),
			),
		),
	)
);
<?php

//config/autoload/doctrine.global.php
return array(
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host' => 'localhost',
					'port' => '3306',
					'dbname' => 'noizing_zf2',
				    'charset' => 'utf8', // extra
				    'driverOptions' => array(
				        1002=>'SET NAMES utf8'
				    )
				),
			),
		)
	));

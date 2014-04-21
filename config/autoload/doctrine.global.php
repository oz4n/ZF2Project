<?php

//config/autoload/doctrine.global.php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'dbname' => 'noizing_zf2',
                    'charset' => 'utf8', // extra
                    'driverOptions' => [
                        1002 => 'SET NAMES utf8'
                    ]
                ],
            ],
        ]
    ]
];

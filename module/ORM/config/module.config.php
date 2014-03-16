<?php
return array(
    'doctrine' => array(
        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(
                    // pick any listeners you need
                    'Gedmo\Tree\TreeListener',
                    'Gedmo\Timestampable\TimestampableListener',
                    'Gedmo\Sluggable\SluggableListener',
                    'Gedmo\Loggable\LoggableListener',
                    'Gedmo\Sortable\SortableListener'
                )
            )
        ),
        'driver' => array(
            'orm_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/ORM/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'ORM\Entity' => 'orm_driver'
                )
            )
        )
    )
);
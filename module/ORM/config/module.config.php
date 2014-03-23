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
    ),
//     'zfcuser' => array(
//         // telling ZfcUser to use our own class
//         'user_entity_class'       => 'ORM\Entity\UserRole',
//         // telling ZfcUserDoctrineORM to skip the entities it defines
//         'enable_default_entities' => false,
//     ),
    
//     'bjyauthorize' => array(
//         // Using the authentication identity provider, which basically reads the roles from the auth service's identity
//         'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
    
//         'role_providers'        => array(
//             // using an object repository (entity repository) to load all roles into our ACL
//             'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
//                 'object_manager'    => 'doctrine.entitymanager.orm_default',
//                 'role_entity_class' => 'ORM\Entity\UserRole',
//             ),
//         ),
//     ),
);
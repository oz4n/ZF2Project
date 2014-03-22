<?php
namespace Setting\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Setting\Factory\Navigation\AppNavigation;

class NavigationFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $navigation = new AppNavigation();
        return $navigation->createService($serviceLocator);
    }
}
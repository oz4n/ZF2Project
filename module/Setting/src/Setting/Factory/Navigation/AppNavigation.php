<?php

namespace Setting\Factory\Navigation;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;
use Zend\Authentication\Adapter\Exception\InvalidArgumentException;

class AppNavigation extends DefaultNavigationFactory 
{
	protected function getPages(ServiceLocatorInterface $serviceLocator)
	{
		if(null === $this->pages) {
		    $fetchMenu = $serviceLocator->get('menu')->findAllMenu();
		    
		    $configuration['navigation'][$this->getName()] = array();
		    foreach($fetchMenu as $key=>$row)
		    {
		        $configuration['navigation'][$this->getName()][$row['label']] = array(
		            'label' => $row['label'],		            
		            'route' => $row['route'],
		            'id'  => $row['id'],
		            'pages' => $row['pages']		           
		        );
		    }
		     
		    if (!isset($configuration['navigation'])) {
		        throw new InvalidArgumentException('Could not find navigation configuration key');
		    }
		    if (!isset($configuration['navigation'][$this->getName()])) {
		        throw new InvalidArgumentException(sprintf(
		            'Failed to find a navigation container by the name "%s"',
		            $this->getName()
		        ));
		    }
		    
		    $application = $serviceLocator->get('Application');
		    $routeMatch  = $application->getMvcEvent()->getRouteMatch();
		    $router      = $application->getMvcEvent()->getRouter();
		    $pages       = $this->getPagesFromConfig($configuration['navigation'][$this->getName()]);
		    
		    $this->pages = $this->injectComponents($pages, $routeMatch, $router);
		}
		return $this->pages;
	}
}
<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Setting;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
//     public function onBootstrap($e)
//     {
//         $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
//             $controller      = $e->getTarget();
//             $controllerClass = get_class($controller);
//             $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
//             $config          = $e->getApplication()->getServiceManager()->get('config');
//             if (isset($config['module_layouts'][$moduleNamespace])) {
//                 $controller->layout($config['module_layouts'][$moduleNamespace]);
//             }
//         }, 100);
//     }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);       
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'menu' => 'Setting\Model\TermModel'
            )
            ,
            'factories' => array(
                'Navigation' => 'Setting\Factory\NavigationFactory',
                'Breadcrumbs' => 'Setting\Factory\BreadcrumbsFactory'
            )                        
        );
    }
    
    public function getViewHelperConfig()
    {
    	return array(
    	    'invokables' => array(
    	        'NavigationHelper' => 'Setting\View\Helper\NavigationHelper',    	           	       
    	        'BreadcrumbsHelper' => 'Setting\Helper\BreadcrumdsHelper',    	           	       
    	    )
    	);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            ),
        );
    }
}

<?php
namespace Post;



use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{

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
            )
        );
    }
    
    public function onBootstrap($e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch', array($this, 'loadConfiguration' ));
    }
    
    public function loadConfiguration(MvcEvent $e)
    {
        $controller = $e->getTarget();
        $controllerClass = get_class($controller);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
    
        //set 'variable' into layout...
        $controller->layout()->modulenamespace = 'menu-min';
    }

//     /**
//      *
//      * @param \Zend\Mvc\MvcEvent $e
//      *            The MvcEvent instance
//      * @return void
//      */
//     public function onBootstrap($e)
//     {
//         // Register a render event
//         $app = $e->getParam('application');
//         $app->getEventManager()->attach('render', array(
//             $this,
//             'setLayoutTitle',
//         ));        
       
//     }
    
    

//     /**
//      *
//      * @param \Zend\Mvc\MvcEvent $e
//      *            The MvcEvent instance
//      * @return void
//      */
//     public function setLayoutTitle($e)
//     {
//         $matches = $e->getRouteMatch();
//         $action = $matches->getParam('action');
//         $controller = $matches->getParam('controller');
//         $module = __NAMESPACE__;
//         $siteName = 'Zend Framework 2';
        
//         // Getting the view helper manager from the application service manager
//         $viewHelperManager = $e->getApplication()
//             ->getServiceManager()
//             ->get('viewHelperManager');
        
//         // Getting the headTitle helper from the view helper manager
//         $headTitleHelper = $viewHelperManager->get('headTitle');
        
//         // Setting a separator string for segments
//         $headTitleHelper->setSeparator(' - ');
        
//         // Setting the action, controller, module and site name as title segments
//         $headTitleHelper->append($action);
//         $headTitleHelper->append($controller);
//         $headTitleHelper->append($module);
//         $headTitleHelper->append($siteName);
//     }
    
}

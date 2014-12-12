<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 100);
    }

    public function onDispatch(MvcEvent $mvcEvent)
    {
        $viewModel = $mvcEvent->getViewModel();
        $serviceManager = $mvcEvent->getApplication()->getServiceManager();
        $categories = $serviceManager->get('categories');
        $viewModel->setVariable('categories', $categories);
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
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'services' => array(
                'categories' => array(
                    'barter',
                    'beauty',
                    'clothing',
                    'computer',
                    'entertainment',
                    'free',
                    'garden',
                    'general',
                    'health',
                    'household',
                    'phones',
                    'property',
                    'sporting',
                    'tools',
                    'transportation',
                    'wanted',
                ),
            ),
        );
    }

}

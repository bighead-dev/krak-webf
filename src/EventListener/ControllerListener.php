<?php

namespace Krak\Webf\EventListener;

use Krak\Webf\Application;
use Krak\Webf\ApplicationAwareInterface;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ControllerListener implements EventSubscriberInterface
{
    private $app;
    
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Adds the Application to the controller
     */
    public function filterController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        
        if (is_array($controller) && is_object($controller[0])) {
            $object = $controller[0];
        }
        else if (is_object($controller)) {
            $object = $controller;
        }
        else {
            return; /* no controller object can be found */
        }
        
        if ($object instanceof ApplicationAwareInterface) {
            $object->setApplication($this->app);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array('filterController', 0)
        );
    }
}

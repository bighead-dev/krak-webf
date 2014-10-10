<?php

namespace Krak\Webf;

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Krak\Webf\EventListener\ControllerListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;

abstract class Bootstrap
{
    protected function createRouter(Application $app, Request $request)
    {
        return new Router(
            new PhpFileLoader(),
            $app->getConfigPath() . '/routes.php'
        );
    }
    
    protected function registerEventListeners(
        Application $app,
        EventDispatcherInterface $dispatcher
    )
    {
        $dispatcher->addSubscriber(new RouterListener($app->getRouter()));
        $dispatcher->addSubscriber(new ControllerListener($app));
    }
    
    protected function createEventDispatcher(Application $app, Request $request)
    {
        $dispatcher = new EventDispatcher();
        $this->registerEventListeners($app, $dispatcher);
        
        return $dispatcher;
    }
    
    protected function createRequestStack(Application $app, Request $request)
    {
        return new RequestStack();
    }
    
    protected function createControllerResolver(Application $app, Request $request)
    {
        return new ControllerResolver();
    }
    
    protected function createEnvironment(Application $app, Request $request)
    {
        return 'development';
    }
    
    protected function createRootDir(Application $app, Request $request)
    {
        return $request->server->get('DOCUMENT_ROOT');
    }
    
    protected function createConfigPath(Application $app, Request $request)
    {
        return $app->getRootDir() . '/config';
    }
    
    protected function createHttpKernel(Application $app, Request $request)
    {
        return new HttpKernel(
            $app->getEventDispatcher(),
            $app->getControllerResolver(),
            $app->getRequestStack()
        );
    }
    
    public function initializeApplication(Application $app, Request $request)
    {
        return $app->setEnvironment(
                $this->createEnvironment($app, $request)
            )
            ->setRootDir(
                $this->createRootDir($app, $request)
            )
            ->setConfigPath(
                $this->createConfigPath($app, $request)
            )
            ->setRouter(
                $this->createRouter($app, $request)
            )
            ->setEventDispatcher(
                $this->createEventDispatcher($app, $request)
            )
            ->setControllerResolver(
                $this->createControllerResolver($app, $request)
            )
            ->setRequestStack(
                $this->createRequestStack($app, $request)
            )
            ->setHttpKernel(
                $this->createHttpKernel($app, $request)
            );
    }
    
    /**
     * Application main function
     */
    public function main(Application $app)
    {
        $request = Request::createFromGlobals();
        
        $app = $this->initializeApplication($app, $request);
        
        $response = $app->handle($request);
        $response->send();
        $app->terminate($request, $response);
    }
}

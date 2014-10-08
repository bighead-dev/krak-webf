<?php

namespace Krak\Webf;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\Routing\RouterInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

/**
 * Application Interface
 * The application acts as the main container for an actual web app. All of the state
 * for an app is stored in this class. This acts as verbose DI container and prevents the
 * use of global state.
 *
 * This interface only requires the absolute bare minimum to get an application up
 * and running.
 */
interface Application extends HttpKernelInterface, TerminableInterface
{
    public function getEventDispatcher();
    public function setEventDispatcher(EventDispatcherInterface $dispatcher);
    
    public function getHttpKernel();
    public function setHttpKernel(HttpKernelInterface $kernel);
    
    public function getRouter();
    public function setRouter(RouterInterface $router);
    
    public function getControllerResolver();
    public function setControllerResolver(ControllerResolverInterface $resolver);
    
    public function getEnvironment();
    public function setEnvironment($env);
    
    public function getRequestStack();
    public function setRequestStack(RequestStack $stack);
    
    public function getConfigPath();
    public function setConfigPath($config_path);
    
    public function getRootDir();
    public function setRootDir($root_dir);
    
    public function handle(
        Request $request,
        $type = HttpKernelInterface::MASTER_REQUEST,
        $catch = true
    );
    public function terminate(Request $request, Response $response);
}

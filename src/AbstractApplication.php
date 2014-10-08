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
 * Basic implementation of the Application
 */
abstract class AbstractApplication implements Application
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;
    
    /**
     * @var HttpKernelInterface
     */
    protected $kernel;
    
    /**
     * @var ControllerResolverInterface
     */
    protected $resolver;
    
    /**
     * @var RouterInterface
     */
    protected $router;
    
    /**
     * @var RequestStack
     */
    protected $stack;
    
    /**
     * @var string
     */
    protected $environment;
    
    /**
     * @var string
     */
    protected $config_path;
    
    /**
     * @var string
     */
    protected $root_dir;
        
    public function getEventDispatcher()
    {
        return $this->dispatcher;
    }
    public function setEventDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        return $this;
    }
    
    public function getHttpKernel()
    {
        return $this->kernel;
    }
    public function setHttpKernel(HttpKernelInterface $kernel)
    {
        $this->kernel = $kernel;
        return $this;
    }
    
    public function getRouter()
    {
        return $this->router;
    }
    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
        return $this;
    }
    
    public function getControllerResolver()
    {
        return $this->resolver;
    }
    public function setControllerResolver(ControllerResolverInterface $resolver)
    {
        $this->resolver = $resolver;
        return $this;
    }
    
    public function getEnvironment()
    {
        return $this->environment;
    }
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
        return $this;
    }
    
    public function getRequestStack()
    {
        return $this->stack;
    }
    public function setRequestStack(RequestStack $stack)
    {
        $this->stack = $stack;
        return $this;
    }
    
    public function getConfigPath()
    {
        return $this->config_path;
    }
    public function setConfigPath($path)
    {
        $this->config_path = $path;
        return $this;
    }
    
    public function getRootDir()
    {
        return $this->root_dir;
    }
    public function setRootDir($dir)
    {
        $this->root_dir = $dir;
        return $this;
    }
    
    public function handle(
        Request $request,
        $type = HttpKernelInterface::MASTER_REQUEST,
        $catch = true
    )
    {
        return $this->getHttpKernel()->handle($request, $type, $catch);
    }
    
    public function terminate(Request $request, Response $response)
    {
        $kernel = $this->getHttpKernel();
        
        if ($kernel instanceof TerminableInterface == false) {
            return;
        }
        
        return $kernel->terminate($request, $response);
    }
}

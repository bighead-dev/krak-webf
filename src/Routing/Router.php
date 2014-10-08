<?php

namespace Krak\Webf\Routing;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;

use Symfony\Component\Routing\RouteCollection;

class Router implements RouterInterface
{
    private $context;
    private $routes;
    
    public function __construct(RouteCollection $routes, RequestContext $context)
    {
        $this->setContext($context);
        $this->routes       = $routes;
        $this->matcher      = new UrlMatcher($routes, $context);
        $this->generator    = new UrlGenerator($routes, $context);
    }
    
    public function setContext(RequestContext $context)
    {
        $this->context = $context;
        return $this;
    }
    
    public function getContext()
    {
        return $this->context;
    }
    
    public function match($pathinfo)
    {
        return $this->matcher->match($pathinfo);
    }
    
    public function generate($name, $parameters = array(), $absolute = false)
    {
        return $this->generator->generate($name, $parameters, $absolute);
    }
    
    public function getRouteCollection()
    {
        return $this->routes;
    }
}

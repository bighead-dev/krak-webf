<?php

namespace Krak\Webf\Routing;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

use Closure;

/**
 * Route Collection Builder
 * Implements the fluent interface
 */
class RouteCollectionBuilder
{
    /**
     * @var RouteCollection
     */
    private $collection;
    
    /**
     * @var Route
     */
    private $route;
    
    /**
     * @var string
     */
    private $route_name;
    
    
    public function __construct()
    {
        $this->init();
    }
    
    private function init()
    {
        $this->collection = new RouteCollection();
    }
    
    /**
     * Add a prefix to the route collection
     */
    public function prefix($prefix)
    {
        $this->collection->addPrefix($prefix);
        return $this;
    }
    
    /* Route functions */
    
    /**
     * Creates a route to be added
     */
    public function route($path)
    {
        /* was there already a route being built? */
        if ($this->route) {
            /* add the current route into the collection */
            $this->collection->add($this->getRouteName(), $this->route);
        }
    
        $this->route = new Route($path);
        $this->route_name = null;
        
        return $this;
    }
    
    /**
     * Gets the current routes name
     */
    private function getRouteName()
    {
        static $route_counter = 0;
        
        if ($this->route_name) {
            return $this->route_name;
        }
        
        $msg = sprintf('route_%d', $route_counter++);
        return sprintf('%s_%s', $msg, substr(sha1($msg), 0, 5));
    }
    
    public function defaults($defaults)
    {
        $this->route->addDefaults($defaults);
        return $this;
    }
    
    public function name($name)
    {
        $this->route_name = $name;
        return $this;
    }
    
    public function requirements($requirements)
    {
        $this->route->addRequirements($requirements);
        return $this;
    }
    
    public function options($options)
    {
        $this->route->addOptions($options);
        return $this;
    }
    
    public function host($host)
    {
        $this->route->setHost($host);
        return $this;
    }
    
    public function schemes($schemes)
    {
        $this->route->setSchemes($schemes);
        return $this;
    }
    
    public function methods($methods)
    {
        $this->route->setMethods($methods);
        return $this;
    }
    
    public function condition($condition)
    {
        $this->route->setCondition($condition);
        return $this;
    }
    
    /**
     * Sets the controller action for the route
     */
    public function action($action)
    {
        $this->route->addDefaults(array(
            '_controller'   => $action
        ));
        return $this;
    }
    
    public function create()
    {
        if ($this->route) {
            $this->collection->add($this->route_name, $this->route);
        }
        
        $col = $this->collection;
        
        $this->init();
        
        return $col;
    }
}

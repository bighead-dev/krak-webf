<?php

namespace Krak\Tests\Routing;

use Krak\Webf\Routing\RouteCollectionBuilder;
use Krak\Tests\KrakTestCase;

use Symfony\Component\Routing\RouteCollection;

class BuilderTest extends KrakTestCase
{
    public function testNew()
    {
        $builder = new RouteCollectionBuilder();
        
        $this->assertTrue($builder instanceof RouteCollectionBuilder);
    }
    
    public function testCollection()
    {
        $builder = new RouteCollectionBuilder();
        
        $collection = $builder->create();
        
        $this->assertTrue($collection instanceof RouteCollection);
    }
    
    public function testOne()
    {
        $builder = new RouteCollectionBuilder();
        
        $collection = $builder
            ->route('session_start', '/session/start')
            ->create();
        
        $this->assertCount(1, $collection);
    }
    
    public function testMany()
    {
        $builder = new RouteCollectionBuilder();
        
        $collection = $builder
            ->route('session_start', '/session/start')
                ->action('Acme\Controller\Session::index')
            ->route('session_end', '/session/destroy')
                ->action('Acme\Controller\Session::destroy')
            ->create();
                
        $this->assertCount(2, $collection);
    }
    
    
}

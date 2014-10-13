<?php

namespace Krak\Tests\Routing;

use Krak\Webf\Routing\RouteCollectionBuilder;
use Krak\Tests\TestCase;

use Symfony\Component\Routing\RouteCollection;

class BuilderTest extends TestCase
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
            ->route('/session/start')
                ->name('session_start')
            ->create();
        
        $this->assertCount(1, $collection);
        $this->assertTrue($collection->get('session_start') != null);
    }
    
    public function testMany()
    {
        $builder = new RouteCollectionBuilder();
        
        $collection = $builder
            ->route('/session/start')
                ->name('session_start')
                ->action('Acme\Controller\Session::index')
            ->route('/session/destroy')
                ->name('session_end')
                ->action('Acme\Controller\Session::destroy')
            ->create();
                
        $this->assertCount(2, $collection);
    }
    
    
}

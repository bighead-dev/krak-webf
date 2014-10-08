<?php

namespace Krak\Tests\Routing;

use Krak\Webf\Routing\RouteCollectionFactory;
use Symfony\Component\Routing\RouteCollection;

use Krak\Tests\KrakTestCase;

class FactoryTest extends KrakTestCase
{
    public function testCreate()
    {
        $collection = RouteCollectionFactory::createFromFile(
            __DIR__ . '/routing-conf.php'
        );
        
        $this->assertTrue($collection instanceof RouteCollection);
    }
    
    public function testException()
    {
        try {
            $collection = RouteCollectionFactory::createFromFile(
                __DIR__ . '/routing-conf-bad.php'
            );
        } catch (\RuntimeException $e) {
            $this->assertTrue(true);
            return;
        }
        
        /* this should have thrown an exception */
        $this->assertTrue(false);
    }
}

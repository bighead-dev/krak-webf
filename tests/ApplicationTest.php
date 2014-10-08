<?php

namespace Krak\Tests;

use Krak\Webf\Application;
use Symfony\Component\HttpKernel\Client;
use Symfony\Component\HttpFoundation\Request;

class ApplicationTest extends KrakTestCase
{
    public function testCreate()
    {
        $app = new TestApplication();
        
        $this->assertTrue($app instanceof Application);
    }
    
    public function testBootstrap()
    {
        $app    = new TestApplication();
        $bs     = new TestBootstrap();
        
        $request = Request::createFromGlobals();
        $request->server->set('DOCUMENT_ROOT', __DIR__ . '/..');
        
        $app = $bs->initializeApplication($app, $request);
        
        /* make sure it was initialized */
        $this->assertTrue(strlen($app->getRootDir()) > 0);
        
        $client = new Client($app);
        $client->request('GET', TestBootstrap::TEST_ROUTE_PATH);
        
        $resp = $client->getResponse();
        
        $this->assertEquals($resp->getContent(), TestBootstrap::TEST_RESP_CONTENT);
    }
    
    public function testController()
    {
        $app    = new TestApplication();
        $bs     = new TestBootstrap();
        
        $request = Request::createFromGlobals();
        $request->server->set('DOCUMENT_ROOT', __DIR__ . '/..');
        
        $app = $bs->initializeApplication($app, $request);
        
        $client = new Client($app);
        $client->request('GET', '/test2');
        
        $resp = $client->getResponse();
        
        $this->assertEquals($resp->getContent(), $app->getConfigPath());
    }
}

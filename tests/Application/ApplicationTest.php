<?php

namespace Krak\Tests;

use Krak\Webf\Bootstrap;
use Krak\Webf\Application;

use Symfony\Component\HttpKernel\Client;
use Symfony\Component\HttpFoundation\Request;

use Krak\Tests\TestCase;
use Krak\Tests\Fixtures\App\TestApplication;
use Krak\Tests\Fixtures\App\TestBootstrap;
use Krak\Tests\Fixtures\App\RouterTestBootstrap;

class ApplicationTest extends TestCase
{
    /**
     * Make sure the test objects aren't stanky
     */
    public function testCreate()
    {
        $this->assertTrue((new TestApplication()) instanceof Application);
        $this->assertTrue((new TestBootstrap()) instanceof Bootstrap);
        $this->assertTrue((new RouterTestBootstrap()) instanceof Bootstrap);
    }
    
    private function setupRouteTestApp(Bootstrap $bs)
    {
        $app    = new TestApplication();
        
        $request = Request::createFromGlobals();
        $request->server->set('DOCUMENT_ROOT', __DIR__ . '/..');
        
        return $bs->initializeApplication($app, $request);
    }
    
    /**
     * Run a simple test of initializing the system
     */
    public function testAppInit()
    {
        $app = $this->setupRouteTestApp(new TestBootstrap());
        
        /* just make sure there weren't any errors on startup */
        $this->assertTrue(strlen($app->getConfigPath()) > 0);
    }
    
    /**
     * Test bootstrap using a configured router
     */
    public function testRouterBootstrap()
    {
        $app = $this->setupRouteTestApp(new RouterTestBootstrap());
        
        /* make sure it was initialized */
        $this->assertTrue(strlen($app->getRootDir()) > 0);
        
        $client = new Client($app);
        $client->request('GET', RouterTestBootstrap::TEST_ROUTE_PATH);
        
        $resp = $client->getResponse();
        
        $this->assertEquals($resp->getContent(), RouterTestBootstrap::TEST_RESP_CONTENT);
    }
    
    public function testController()
    {
        $app = $this->setupRouteTestApp(new RouterTestBootstrap());
        
        $client = new Client($app);
        $client->request('GET', '/test2');
        
        $resp = $client->getResponse();
        
        $this->assertEquals($resp->getContent(), $app->getConfigPath());
    }
}

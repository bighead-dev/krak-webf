<?php

namespace Krak\Tests;

use Krak\Webf\Application;
use Krak\Webf\Bootstrap;
use Krak\Webf\Routing\Router;
use Krak\Webf\Routing\RouteCollectionBuilder;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestBootstrap extends Bootstrap
{
    const TEST_ROUTE_PATH   = '/test1';
    const TEST_ROUTE        = 'test1';
    const TEST_RESP_CONTENT = 'abc';

    protected function createRouter(Application $app, Request $request)
    {
        $builder = new RouteCollectionBuilder();
        $routes = $builder
            ->route('test1', '/test1')
                ->action(function(){return new Response(self::TEST_RESP_CONTENT);})
            ->route('test2', '/test2')
                ->action('Krak\\Tests\\TestController::test')
            ->create();
                
        $context = new RequestContext();
        $context->fromRequest($request);
        
        return new Router($routes, $context);
    }
}

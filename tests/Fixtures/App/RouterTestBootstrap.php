<?php

namespace Krak\Tests\Fixtures\App;

use Krak\Webf\Application;
use Krak\Webf\Bootstrap;
use Krak\Webf\Routing\RouteCollectionBuilder;

use Symfony\Component\Routing\Loader\ClosureLoader;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RouterTestBootstrap extends Bootstrap
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
                ->action('Krak\\Tests\\Fixtures\\App\\TestController::test')
            ->create();
                        
        return new Router(
            new ClosureLoader(),
            function() use ($routes) {
                return $routes;
            }
        );
    }
}

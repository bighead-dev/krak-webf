<?php

use Symfony\Component\HttpFoundation\Response;

$builder = new Krak\Webf\Routing\RouteCollectionBuilder();

return $builder
    ->route('/home')
        ->name('home')
        ->action(function()
        {
            return new Response('home-test');
        })
    ->create();

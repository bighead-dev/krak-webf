<?php

$builder = new Krak\Webf\Routing\RouteCollectionBuilder();


return $builder
    ->route('bite5_get', '/bite5/{id}')
        ->action('Bite5\Controller\Bite5::index')
        ->defaults([
            'id'  => null
        ])
        ->requirements([
            'id'    => '\d+'
        ])
    ->route('bite5_list', '/bite5')
        ->action('Bite5\Controller\Bite5::list')
    ->prefix('/api')
    ->create();

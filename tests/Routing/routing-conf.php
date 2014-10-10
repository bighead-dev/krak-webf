<?php

$builder = new Krak\Webf\Routing\RouteCollectionBuilder();


return $builder
    ->route('/bite5/{id}')
        ->name('bite5_get')
        ->action('Bite5\Controller\Bite5::index')
        ->defaults([
            'id'  => null
        ])
        ->requirements([
            'id'    => '\d+'
        ])
    ->route('/bite5')
        ->name('bite5_list')
        ->action('Bite5\Controller\Bite5::list')
    ->prefix('/api')
    ->create();

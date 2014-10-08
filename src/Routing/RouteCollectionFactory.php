<?php

namespace Krak\Webf\Routing;

use Symfony\Component\Routing\RouteCollection;

class RouteCollectionFactory
{
    public static function createFromFile($file)
    {
        $collection = require $file;
        
        if ($collection instanceof RouteCollection == false) {
            throw new \RuntimeException(
                'Config file did not return an instance of RouteCollection'
            );
        }
        
        return $collection;
    }
}

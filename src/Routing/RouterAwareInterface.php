<?php

namespace Krak\Webf\Routing;

use Symfony\Comonpent\Routing\RouterInterface;

interface RouterAwareInterface
{
    /**
     * @return RouterInterface
     */
    public function getRouter();
    
    /**
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router);
}

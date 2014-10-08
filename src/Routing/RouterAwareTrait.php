<?php

namespace Krak\Webf\Routing;

use Symfony\Comonpent\Routing\RouterInterface;

trait RouterAwareTrait
{
    private $router;

    /**
     * @return RouterInterface
     */
    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
        return $this;
    }
}

<?php

namespace Krak\Tests;

use Symfony\Component\HttpFoundation\Response;

use Krak\Webf\Application;
use Krak\Webf\ApplicationAwareInterface;

class TestController implements ApplicationAwareInterface
{    
    private $app;

    public function test()
    {
        return new Response($this->app->getConfigPath());
    }
    
    public function setApplication(Application $app)
    {
        $this->app = $app;
    }
    
    public function getApplication()
    {
        return $this->app;
    }
}

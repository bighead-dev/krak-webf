<?php

namespace Krak\Tests\Fixtures\App;

use Krak\Webf\Application;
use Krak\Webf\Bootstrap;
use Symfony\Component\HttpFoundation\Request;

class TestBootstrap extends Bootstrap
{
    public function createRootDir(Application $app, Request $req)
    {
        return __DIR__;
    }
}

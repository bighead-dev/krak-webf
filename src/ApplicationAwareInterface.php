<?php

namespace Krak\Webf;

interface ApplicationAwareInterface
{
    public function getApplication();
    public function setApplication(Application $app);
}

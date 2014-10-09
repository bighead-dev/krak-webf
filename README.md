# Krak WebFramework

The Krak WebFramework is merely just a simple wrapper around the Symfony Kernel.

## Usage

To startup the Symfony framework, you need to create application specific instances of the `Krak\Webf\Boostrap` and `Krak\Webf\Application`.

```php
<?php

namespace Acme;

use Krak\Webf\AbstractApplication;

class AcmeApplication extends AbstractApplication
{}
```

```php
<?php

namespace Acme;

use Krak\Webf\Bootstrap;

class AcmeBootstrap extends Bootstrap
{}
```

Then in your front controller:

```php
<?php

$bootstrap = new Acme\AcmeBootstrap();
$bootstrap->main(new Acme\AcmeApplication());
```

And that's it!

If you want to change the defaults or add even more initialization then do so in the Bootstrap class.

## Application and Bootstrap

The Application manages the global state for you application. It acts as simple DI Container, but it's a little more verbose and type safe. The Application interface just holds the bare minimum for running an application, you typically will need to add much more in your own Application file to fit your Application's needs.

The Bootstrap is the application bootstrap which initializes the system. You can view the base bootstrap class to see which methods can be overridden and whatnot.

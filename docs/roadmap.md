# Road Map

The following is a list of features roughly sorted by priority.

- Cleaner Routing
- Lambda Controllers with an application instance
- Controller setter/constructor injection

## Cleaner Routing

Implement a routing system that works well for Api's and large scale sites. Also implement, a system similar to silex where you can have a syntax like:

```php
$app->get(function(){});
```

## Lambda Controllers

Currently, only Controller classes that implement the ApplicationAwareInterface will get an instance of the application injected. Implement the ability for the closures to get the application instance also by either binding the closure to the application or by passing it in as a parameter.

## Controller setter/constructor injection

Very similar to symfony's controller as a service.

# SimpleRoute

[![Build Status](https://travis-ci.org/AndrewCarterUK/SimpleRoute.svg?branch=master)](https://travis-ci.org/AndrewCarterUK/SimpleRoute)
[![Code Coverage](https://scrutinizer-ci.com/g/AndrewCarterUK/SimpleRoute/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/AndrewCarterUK/SimpleRoute/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/AndrewCarterUK/SimpleRoute/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/AndrewCarterUK/SimpleRoute/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/andrewcarteruk/simple-route/v/stable)](https://packagist.org/packages/andrewcarteruk/simple-route)
[![Total Downloads](https://poser.pugx.org/andrewcarteruk/simple-route/downloads)](https://packagist.org/packages/andrewcarteruk/simple-route)
[![License](https://poser.pugx.org/andrewcarteruk/simple-route/license)](https://packagist.org/packages/andrewcarteruk/simple-route)

This easy to use router is a simple wrapper for the [FastRoute](https://github.com/nikic/FastRoute) library.

By [AndrewCarterUK ![(Twitter)](http://i.imgur.com/wWzX9uB.png)](https://twitter.com/AndrewCarterUK)

## Install

Install using [Composer](https://getcomposer.org).

```bash
composer require andrewcarteruk/simple-route ^0.2
```

## Example Usage

```php
use SimpleRoute\Route;
use SimpleRoute\Router;

$router = Router::fromArray([
    new Route('GET', '/', 'handler1'),
    new Route('GET', '/{page}', 'handler2'),
]);

try {
    $result = $router->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

    $handler = $result->getHandler();
    $params = $result->getParams();

    // ...
} catch (SimpleRoute\Exception\NotFoundException $exception) {
    // ...
} catch (SimpleRoute\Exception\MethodNotAllowedException $exception) {
    // ...
}
```

## Documentation

_The following documentation is derived from the [FastRoute](https://github.com/nikic/FastRoute#defining-routes)
documentation._

Routes are defined as an array of `SimpleRoute\Route` objects that are passed to
`SimpleRoute\Router::fromArray(array $routes)`.

`SimpleRoute\Route` objects require a `$method`, a `$pattern` and a `$handler`:

```php
$route = new Route($method, $pattern, $handler);
```

The `$method` is an uppercase HTTP method string for which a certain route
should match. It is possible to specify multiple valid methods using an array:

```php
$routes = [
    // This route
    new Route(['GET', 'POST'], '/test', 'handler'),

    // Is equivalent to these two routes together
    new Route('GET', '/test', 'handler'),
    new Route('POST', '/test', 'handler'),
];
```

By default the `$pattern` uses a syntax where `{foo}` specifies a placeholder
with name `foo` and matching the regex `[^/]+`. To adjust the pattern the
placeholder matches, you can specify a custom pattern by writing `{bar:[0-9]+}`.

Some examples:

```php
$routes = [
    // Matches /user/42, but not /user/xyz
    new Route('GET', '/user/{id:\d+}', 'handler'),

    // Matches /user/foobar, but not /user/foo/bar
    new Route('GET', '/user/{name}', 'handler'),

    // Matches /user/foo/bar as well
    new Route('GET', '/user/{name:.+}', 'handler'),
];
```

Custom patterns for route placeholders cannot use capturing groups. For example
`{lang:(en|de)}` is not a valid placeholder, because `()` is a capturing group.
Instead you can use either `{lang:en|de}` or `{lang:(?:en|de)}`.

Furthermore parts of the route enclosed in `[...]` are considered optional, so
that `/foo[bar]` will match both `/foo` and `/foobar`. Optional parts are only
supported in a trailing position, not in the middle of a route.

```php
$routes = [
    // This route
    new Route('GET', '/user/{id:\d+}[/{name}]', 'handler'),

    // Is equivalent to these two routes together
    new Route('GET', '/user/{id:\d+}', 'handler'),
    new Route('GET', '/user/{id:\d+}/{name}', 'handler'),

    // This route is NOT valid, because optional parts can only occur at the end
    new Route('GET', '/user[/{id:\d+}]/{name}', 'handler'),
];
```

The `$handler` parameter does not necessarily have to be a callback, it could
also be a controller class name or any other kind of data you wish to associate
with the route. SimpleRoute only tells you which handler corresponds to your
URI, how you interpret it is up to you.

### Credits

This library is merely a wrapper for [FastRoute](https://github.com/nikic/FastRoute)
that aims to provide an easier to use API.

The author of [FastRoute](https://github.com/nikic/FastRoute) is [Nikita Popov](http://nikic.github.io/).

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
composer require andrewcarteruk/simple-route ^0.1
```

## Example Usage

```php
use SimpleRoute\Exception\MethodNotAllowedException;
use SimpleRoute\Exception\NotFoundException;
use SimpleRoute\Route;
use SimpleRoute\Router;

$router = new Router([
    new Route('GET', '/', 'handler1'),
    new Route(['GET', 'POST'], '/contact', 'handler2'),
    new Route('GET', '/{page}', 'handler3'),
]);

try {
    $result = $router->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

    $handler = $result->getHandler();
    // ...
} catch (NotFoundException $exception) {
    // ...
} catch (MethodNotAllowedException $exception) {
    // ...
}
```

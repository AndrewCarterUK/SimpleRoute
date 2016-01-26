<?php

namespace SimpleRoute;

use FastRoute;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use SimpleRoute\Exception\MethodNotAllowedException;
use SimpleRoute\Exception\NotFoundException;

final class Router implements RouterInterface
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var RouteInterface[]
     */
    private $routes;

    /**
     * @param RouteInterface[] A collection of routes
     */
    public function __construct(array $routes)
    {
        $this->routes = array();

        $this->dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $collector) use ($routes) {
            foreach ($routes as $route) {
                if (!$route instanceof RouteInterface) {
                    throw new \InvalidArgumentException('Routes array must contain only RouteInterface objects');
                }

                $key = spl_object_hash($route);

                $this->routes[$key] = $route;

                $collector->addRoute($route->getMethods(), $route->getPattern(), $key);
            }
        });
    }

    /**
     * {@inheritdoc}
     */
    public function match($method, $uri)
    {
        $routeInfo = $this->dispatcher->dispatch($method, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new MethodNotAllowedException($method, $routeInfo[1]);
            case Dispatcher::NOT_FOUND:
                throw new NotFoundException($uri);
        }

        return new Result($this->routes[$routeInfo[1]], $routeInfo[2]);
    }
}

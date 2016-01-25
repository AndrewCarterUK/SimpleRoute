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
     * @var RouteInterface
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
                $key = spl_object_hash($route);

                $this->routes[$key] = $route;

                if (!$route instanceof RouteInterface) {
                    throw new \InvalidArgumentException('Routes array must contain only RouteInterface objects');
                }

                $collector->addRoute(
                    $route->getMethods(),
                    $route->getPattern(),
                    $key
                );
            }
        });
    }

    /**
     * {@inheritdoc}
     */
    public function match($method, $uri)
    {
        $result = $this->dispatcher->dispatch($method, $uri);

        switch ($result[0]) {
            case Dispatcher::FOUND:
                return new Result($this->routes[$result[1]], $result[2]); 
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new MethodNotAllowedException($method, $result[1]);
            case Dispatcher::NOT_FOUND:
                throw new NotFoundException($uri);
        }
    }
}

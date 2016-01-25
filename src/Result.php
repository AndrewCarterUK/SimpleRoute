<?php

namespace SimpleRoute;

final class Result implements ResultInterface
{
    /**
     * @var RouteInterface
     */
    private $route;

    /**
     * @var array
     */
    private $params;

    /**
     * @param RouteInterface $route
     * @param array $params
     */
    public function __construct(RouteInterface $route, array $params)
    {
        $this->route = $route;
        $this->params = $params;
    }

    /**
     * {@inheritdoc}
     */
    public function getHandler()
    {
        return $this->route->getHandler();
    }

    /**
     * {@inheritdoc}
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoute()
    {
        return $this->route;
    }
}

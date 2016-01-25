<?php

namespace SimpleRoute;

interface RouterInterface
{
    /**
     * Match a HTTP request to a route.
     * 
     * @param string $method The HTTP method
     * @param string $uri The HTTP URI
     * @return ResultInterface
     */
    public function match($method, $uri);
}

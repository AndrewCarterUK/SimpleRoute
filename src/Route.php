<?php

namespace SimpleRoute;

final class Route implements RouteInterface
{
    /**
     * @var array
     */
    private static $availableMethods = [
        'GET',
        'POST',
        'PUT',
        'PATCH',
        'DELETE',
        'HEAD',
    ];

    /**
     * @var string[]
     */
    private $methods;

    /**
     * @var string
     */
    private $pattern;

    /**
     * @var mixed
     */
    private $handler;

    /**
     * @param string|string[] $method The HTTP method, or an array of, to match 
     * @param string $pattern The URI pattern
     * @param mixed $handler The handler
     */
    public function __construct($method, $pattern, $handler)
    {
        if (is_array($method)) {
            $this->methods = $method;
        } else {
            $this->methods = array($method);
        }

        $this->pattern = $pattern;
        $this->handler = $handler;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * {@inheritdoc}
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * {@inheritdoc}
     */
    public function getHandler()
    {
        return $this->handler;
    }
}

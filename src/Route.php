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
     * @param string $method    The HTTP method type
     * @param string $arguments The arguments to allow __construct to be called
     *
     * @throws \InvalidArgumentException
     *
     * @return Route
     */
    public static function __callStatic($method, $arguments)
    {
        if (in_array($method, static::$availableMethods) === false) {
            throw new \InvalidArgumentException(
                sprintf('%s is not a valid method', $method)
            );
        }

        list($pattern, $handler) = $arguments;

        return new self(
            $method, $pattern, $handler
        );
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

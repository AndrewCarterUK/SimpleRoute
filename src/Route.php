<?php

namespace SimpleRoute;

final class Route implements RouteInterface
{
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
     * @param string $pattern The URI pattern
     * @param mixed  $handler The handler
     *
     * @return Route
     */
    public static function GET($pattern, $handler)
    {
        return new self(['GET'], $pattern, $handler);
    }

    /**
     * @param string $pattern The URI pattern
     * @param mixed  $handler The handler
     *
     * @return Route
     */
    public static function POST($pattern, $handler)
    {
        return new self(['POST'], $pattern, $handler);
    }

    /**
     * @param string $pattern The URI pattern
     * @param mixed  $handler The handler
     *
     * @return Route
     */
    public static function PUT($pattern, $handler)
    {
        return new self(['PUT'], $pattern, $handler);
    }

    /**
     * @param string $pattern The URI pattern
     * @param mixed  $handler The handler
     *
     * @return Route
     */
    public static function PATCH($pattern, $handler)
    {
        return new self(['PATCH'], $pattern, $handler);
    }

    /**
     * @param string $pattern The URI pattern
     * @param mixed  $handler The handler
     *
     * @return Route
     */
    public static function DELETE($pattern, $handler)
    {
        return new self(['DELETE'], $pattern, $handler);
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

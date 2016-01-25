<?php

namespace SimpleRoute\Exception;

final class MethodNotAllowedException extends \Exception
{
    /**
     * @param string $method
     * @param string[] $allowedMethods
     */
    public function __construct($method, array $allowedMethods)
    {
        parent::__construct($method . ' method is not allowed, must be ' . implode(', ', $allowedMethods));
    }
}

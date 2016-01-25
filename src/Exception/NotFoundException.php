<?php

namespace SimpleRoute\Exception;

final class NotFoundException extends \Exception
{
    /**
     * @param string $uri
     */
    public function __construct($uri)
    {
        parent::__construct('No route found for URI: ' . $uri);
    }
}

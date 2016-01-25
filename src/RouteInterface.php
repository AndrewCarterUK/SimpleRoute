<?php

namespace SimpleRoute;

interface RouteInterface
{
    /**
     * @return string[]
     */
    public function getMethods();

    /**
     * @return string
     */
    public function getPattern();

    /**
     * @return mixed
     */
    public function getHandler();
}

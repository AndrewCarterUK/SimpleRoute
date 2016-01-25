<?php

namespace SimpleRoute;

interface ResultInterface
{
    /**
     * @return mixed
     */
    public function getHandler();

    /**
     * @return array
     */
    public function getParams();

    /**
     * @return RouteInterface
     */
    public function getRoute();
}

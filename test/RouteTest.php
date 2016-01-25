<?php

namespace SimpleRoute\Test;

use SimpleRoute\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    public function testRoute()
    {
        $route = new Route('GET', 'foo', 'bar');

        $this->assertEquals(array('GET'), $route->getMethods());
        $this->assertEquals('foo', $route->getPattern());
        $this->assertEquals('bar', $route->getHandler());
    }

    public function testRouteWithMultipleMethods()
    {
        $route = new Route(array('GET', 'POST'), 'foo', 'bar');

        $this->assertEquals(array('GET', 'POST'), $route->getMethods());
    }
}

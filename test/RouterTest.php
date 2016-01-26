<?php

namespace SimpleRoute\Test;

use SimpleRoute\Route;
use SimpleRoute\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testMatch()
    {
        $route = new Route('GET', '/foo', 'foo');
        $router = Router::fromArray(array($route));
        $result = $router->match('GET', '/foo');

        $this->assertSame($route, $result->getRoute());
    }

    public function testParams()
    {
        $route = new Route('GET', '/user/{id:\d+}', 'foo');
        $router = Router::fromArray(array($route));
        $result = $router->match('GET', '/user/1');

        $this->assertEquals(array('id' => '1'), $result->getParams());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidRoutes()
    {
        $router = Router::fromArray(array('foo', 'bar'));
    }

    /**
     * @expectedException SimpleRoute\Exception\NotFoundException
     */
    public function testNotFound()
    {
        $router = Router::fromArray(array());
        $router->match('GET', '/foo');
    }

    /**
     * @expectedException SimpleRoute\Exception\MethodNotAllowedException
     */
    public function testMethodNotAllowed()
    {
        $router = Router::fromArray(array(
            new Route('GET', '/foo', 'foo')
        ));
        $router->match('POST', '/foo');
    }
}

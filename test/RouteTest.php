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

    public function testRouteHasGETMethod()
    {
        $route = Route::GET('/foo', 'foo');

        $this->assertEquals(array('GET'), $route->getMethods());
        $this->assertEquals('/foo', $route->getPattern());
        $this->assertEquals('foo', $route->getHandler());
    }

    public function testRouteHasPOSTMethod()
    {
        $route = Route::POST('/foo', 'foo');

        $this->assertEquals(array('POST'), $route->getMethods());
        $this->assertEquals('/foo', $route->getPattern());
        $this->assertEquals('foo', $route->getHandler());
    }

    public function testRouteHasPUTMethod()
    {
        $route = Route::PUT('/foo', 'foo');

        $this->assertEquals(array('PUT'), $route->getMethods());
        $this->assertEquals('/foo', $route->getPattern());
        $this->assertEquals('foo', $route->getHandler());
    }

    public function testRouteHasPATCHMethod()
    {
        $route = Route::PATCH('/foo', 'foo');

        $this->assertEquals(array('PATCH'), $route->getMethods());
        $this->assertEquals('/foo', $route->getPattern());
        $this->assertEquals('foo', $route->getHandler());
    }

    public function testRouteHasDELETEMethod()
    {
        $route = Route::DELETE('/foo', 'foo');

        $this->assertEquals(array('DELETE'), $route->getMethods());
        $this->assertEquals('/foo', $route->getPattern());
        $this->assertEquals('foo', $route->getHandler());
    }

    public function testRouteHasHEADMethod()
    {
        $route = Route::HEAD('/foo', 'foo');

        $this->assertEquals(array('HEAD'), $route->getMethods());
        $this->assertEquals('/foo', $route->getPattern());
        $this->assertEquals('foo', $route->getHandler());
    }

    public function testRouteHasOPTIONMethod()
    {
        $route = Route::OPTION('/foo', 'foo');

        $this->assertEquals(array('OPTION'), $route->getMethods());
        $this->assertEquals('/foo', $route->getPattern());
        $this->assertEquals('foo', $route->getHandler());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidStaticMethodCalled()
    {
        Route::WOW('/whoops', 'error');
    }
}

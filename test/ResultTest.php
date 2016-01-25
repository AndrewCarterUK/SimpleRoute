<?php

namespace SimpleRoute\Test;

use SimpleRoute\Result;
use SimpleRoute\Route;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    public function testResult()
    {
        $route = new Route('GET', 'foo', 'bar');
        $result = new Result($route, array('foo' => 'bar'));

        $this->assertSame($route, $result->getRoute());
        $this->assertEquals('bar', $result->getHandler());
        $this->assertEquals(array('foo' => 'bar'), $result->getParams());
    }
}

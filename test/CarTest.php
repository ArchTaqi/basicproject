<?php

namespace unit\muhammadtaqi\basicproject;

use muhammadtaqi\basicproject\Car;
use PHPUnit\Framework\TestCase;

/**
 * Class CarTest
 * @package unit\muhammadtaqi\basicproject
 */
class CarTest extends TestCase
{
    public function testBeep()
    {
        $car = new Car();
        $result = $car->beep();
        $this->assertEquals(true, $result);
    }
}

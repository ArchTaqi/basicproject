<?php 
namespace pl\basicproject;

use PHPUnit\Framework\TestCase;
use pl\basicproject\Car;

class CarTest extends TestCase 
{
    public  function testBeep() {
       $car = new Car();
       $result = $car->beep();
        $this->assertEquals(true, $result);
     }
}
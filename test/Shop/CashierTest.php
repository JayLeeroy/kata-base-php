<?php

namespace Kata\Test\Shop;

use Kata\Shop\Cashier;
use Kata\Shop\Shop;

class CashierTest extends \PHPUnit_Framework_TestCase
{
    /**@var Cashier   The Cashier instance. */
    protected $cashier = null;
    /**@var Shopper|\PHPUnit_Framework_MockObject_MockObject   The Shopper instance. */
    protected $shopper = null;


    protected function setUp()
    {
        $shop = new Shop();

        $this->cashier = new Cashier($shop);

        $this->shopper = $this->initShopper();
    }

    protected function initShopper()
    {
        $shopper = $this->getMockBuilder('Kata\\Shop\\Shopper')->disableOriginalConstructor()->getMock();

        return $shopper;
    }

    /**
     * @dataProvider calculateItemsDataProvider
     *
     * @param float $expectedValue
     * @param array $shoppedItems
     */
    public function testCalculateItems($expectedValue, $shoppedItems)
    {
        $this->cashier->setShopper($this->shopper);
        $this->shopper->expects($this->exactly(1))->method('getItems')->willReturn($shoppedItems);
        $this->assertEquals($expectedValue, $this->cashier->calculatePrice());
    }

    public function calculateItemsDataProvider()
    {
        return array(
            array(0, array()),
            array(32, array('apple')),
            array(1046.99, array('apple', 'light', 'starShip')),
            array(185, array('apple', 'apple', 'apple', 'apple' ,'apple', 'apple')),
            array(1999.98, array('starShip', 'starShip', 'starShip'))
        );
    }

    /**
     * @dataProvider invalidItemsDataProvider
     * @expectedException \InvalidArgumentException
     *
     * @param float $expectedValue
     * @param array $shoppedItems
     */
    public function testInvalidItems($expectedValue, $shoppedItems)
    {
        $this->cashier->setShopper($this->shopper);
        $this->shopper->expects($this->exactly(1))->method('getItems')->willReturn($shoppedItems);
        $this->assertEquals($expectedValue, $this->cashier->calculatePrice());
    }

    public function invalidItemsDataProvider()
    {
        return array(
            array(43, array('banana')),
            array(32, array('')),
        );
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidShopper()
    {
        $this->cashier->calculatePrice();
    }
}
 
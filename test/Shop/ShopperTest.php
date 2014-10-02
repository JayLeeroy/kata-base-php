<?php

namespace Kata\Test\Shop;

use Kata\Shop\Shopper;

class ShopperTest extends \PHPUnit_Framework_TestCase
{
    /**@var Shopper   The Shopper instance. */
    protected $shopper = null;

    protected function setUp()
    {
        $this->shopper = new Shopper();
    }

    public function testInitBucket()
    {
        $this->assertEmpty($this->shopper->getItems());
    }

    /**
     * @param $item            string
     * @param $expectedItems   array
     *
     * @depends testInitBucket
     * @dataProvider addItemToBucketDataProvider
     */
    public function testAddItemToBucket($item, $expectedItems)
    {
        $this->shopper->addItem($item);
        $this->assertEquals($expectedItems, $this->shopper->getItems());
    }

    public function addItemToBucketDataProvider()
    {
        return array(
            array('apple', array('apple')),
            array('light', array('apple', 'light')),
            array('', array('apple', 'light')),
        );
    }
}
 
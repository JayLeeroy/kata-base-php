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
     * @param $items   array
     *
     * @dataProvider addItemToBucketDataProvider
     */
    public function testAddItemToBucket($items)
    {
        foreach ($items as $item)
        {
            $this->shopper->addItem($item);
        }
        $this->assertEquals($items, $this->shopper->getItems());
    }

    public function addItemToBucketDataProvider()
    {
        return array(
            array(array('apple')),
            array(array('apple', 'light')),
            array(array('apple', 'light', 'light')),
        );
    }

    /**
     * @param $items         array
     * @param $itemsToRemove array
     * @param $expectedItems array
     *
     * @dataProvider removeItemToBucketDataProvider
     */
    public function testRemoveItemToBucket($items, $itemsToRemove, $expectedItems)
    {
        foreach ($items as $item)
        {
            $this->shopper->addItem($item);
        }

        foreach ($itemsToRemove as $itemToRemove)
        {
            $this->shopper->removeItem($itemToRemove);
        }

        $this->assertEquals($expectedItems, array_values($this->shopper->getItems()));
    }

    public function removeItemToBucketDataProvider()
    {
        return array(
            array(array('apple'), array('apple') , array()),
            array(array('apple', 'light'), array('light'), array('apple')),
            array(array('apple', 'light', 'starShip'), array('light'), array('apple', 'starShip')),
            array(array('apple','apple', 'light'), array('apple','apple', 'light') , array()),
            array(array('apple','light', 'apple'), array('apple') , array('light', 'apple')),
        );
    }
}
 
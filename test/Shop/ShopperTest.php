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

    public function testAddItemToBucket()
    {
        $this->shopper->addItem('apple');

        $this->assertEquals(array('apple'), $this->shopper->getItems());
    }
}
 
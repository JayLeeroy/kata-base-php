<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.09.17.
 * Time: 21:19
 */

namespace Kata\Test\HundredDoors;

use Kata\HundredDoors\HundredDoors;

class HundredDoorsTest extends \PHPUnit_Framework_TestCase
{
    /** @var HundredDoors   The HundredDoors instance. */
    protected $hundredDoors = null;

    protected function setUp()
    {
        $this->hundredDoors = new HundredDoors(100 , 0, false);
    }

    public function testHundredDoorsInstance()
    {
        $this->assertEquals(array_fill(0, 100, false), $this->hundredDoors->getDoors());
    }

    public function testHundredDoors()
    {
        $this->hundredDoors->doSequence();
        $this->assertEquals(range(0,99), $this->hundredDoors->getOpenedDoors());
        $this->hundredDoors->doSequence();
        $this->assertEquals(range(2,99,2), $this->hundredDoors->getOpenedDoors());
    }
}

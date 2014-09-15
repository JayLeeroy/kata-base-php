<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.09.11.
 * Time: 18:37
 */

namespace Kata\Test\PrimeFactor;

    use Kata\PrimeFactor\Prime;

class PrimeTest extends \PHPUnit_Framework_TestCase
{
    public function testPrime()
    {
        $prime = new Prime();

        $this->assertEquals(array(2), $prime->getPrimeFactor(2));
        $this->assertEquals(array(3), $prime->getPrimeFactor(3));
        $this->assertEquals(array(2,2), $prime->getPrimeFactor(4));
        $this->assertEquals(array(2,3), $prime->getPrimeFactor(6));
        $this->assertEquals(array(3,3), $prime->getPrimeFactor(9));
        $this->assertEquals(array(2,2,3), $prime->getPrimeFactor(12));
        $this->assertEquals(array(3,5), $prime->getPrimeFactor(15));

        $this->assertEquals(array(), $prime->getPrimeFactor(1));
    }
}
 
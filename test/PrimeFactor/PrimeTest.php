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
    /**
     * @covers Prime
     * @dataProvider testPrimeDataProvider
     *
     * @param array $expectedPrimeFactors
     * @param int   $number
     */
    public function testPrime($expectedPrimeFactors,$number)
    {
        $prime = new Prime();

        $primeFactors = $prime->getPrimeFactor($number);
        $this->assertEquals($expectedPrimeFactors,$primeFactors);
    }

    public function testPrimeDataProvider()
    {
        return array(
            [array(2), 2],
            [array(3), 3],
            [array(2,2), 4],
            [array(2,3), 6],
            [array(3,3), 9],
            [array(2,2,3), 12],
            [array(3,5), 15],
            [array(1), 1]
        );
    }
}
 
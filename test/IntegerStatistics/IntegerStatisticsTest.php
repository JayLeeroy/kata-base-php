<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.09.17.
 * Time: 21:19
 */

namespace Kata\Test\IntegerStatistics;

use Kata\IntegerStatistics\IntegerStatistics;

class IntegerStatisticsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers IntegerStatistics
     * @dataProvider testIntegerStatisticsDataProvider
     *
     * @param array $array
     * @param float $minimum
     * @param float $maximum
     * @param int   $numberOfElements
     * @param float $average
     */
    public function testIntegerStatistics(array $array, $minimum, $maximum, $numberOfElements, $average)
    {
        $integerStatistics = new IntegerStatistics($array);

        $this->assertEquals($integerStatistics->getMinimum(), $minimum);
        $this->assertEquals($integerStatistics->getMaximum(), $maximum);
        $this->assertEquals($integerStatistics->getNumberOfElements(), $numberOfElements);
        $this->assertEquals($integerStatistics->getAverageValue(), $average, '', 0.001);
    }

    public function testIntegerStatisticsDataProvider()
    {
        return array(
            array([2,3,4,1], 1, 4, 4, 2.5),
            array([6, 9, 15, -2, 92, 11], -2, 92, 6, 21.833333),
            array([2.5 , 4, 8 ,10, 1000 , 23.54], 2.5, 1000, 6, 174.673333)
        );
    }
}
 
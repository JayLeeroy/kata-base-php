<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\Logger;

class LoggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider loggerValuesDataProvider
     *
     * @param $key
     * @param $counter
     * @param $expectedArray
     */
    public function testUserDataValues($key, $counter, $expectedArray)
    {
        $logger = new Logger();

        $logger->logAttempt($key, $counter);

        $this->assertEquals($expectedArray, $logger->getAttempts());
    }

    public function loggerValuesDataProvider()
    {
        return array(
            array('abcd', 0, array()),
            array('abcd', 2, array('abcd' =>  2)),
            array('abcd', 100, array('abcd' =>  100)),
        );
    }
}

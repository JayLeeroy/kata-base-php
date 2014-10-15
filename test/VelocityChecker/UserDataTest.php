<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\UserData;

class UserDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider userDataValuesDataProvider
     *
     * @param $loginName
     * @param $ipCountry
     * @param $registrationIp
     */
    public function testUserDataValues($loginName, $ipCountry, $registrationIp)
    {
        $userData = new UserData($loginName, $ipCountry, $registrationIp);

        $this->assertEquals($loginName, $userData->getLoginName());
        $this->assertEquals($ipCountry, $userData->getIpCountry());
        $this->assertEquals($registrationIp, $userData->getRegistrationIp());
    }

    public function userDataValuesDataProvider()
    {
        return array(
            array('abcd', 'US', '192.168.1.1'),
            array('abcd', 'NA', '192.168.1.2'),
        );
    }
}

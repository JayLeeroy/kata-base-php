<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\LoginData;

class LoginDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider loginDataValuesDataProvider
     *
     * @param $loginName
     * @param $ipCountry
     * @param $loginIp
     */
    public function testUserDataValues($loginName, $ipCountry, $loginIp)
    {
        $loginData = new LoginData($loginName, $ipCountry, $loginIp);

        $this->assertEquals($loginName, $loginData->getLoginName());
        $this->assertEquals($ipCountry, $loginData->getIpCountry());
        $this->assertEquals($loginIp, $loginData->getLoginIp());
    }

    public function loginDataValuesDataProvider()
    {
        return array(
            array('abcd', 'NA', '192.168.1.1'),
            array('abcd', 'US', '192.168.1.2'),
        );
    }
}

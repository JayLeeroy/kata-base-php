<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\CaptchaChecker;
use Kata\VelocityChecker\Logger;

class CaptchaCheckerTest extends \PHPUnit_Framework_TestCase
{
    protected function getIsCaptchaNeeded($logger, $userData, $loginData)
    {
        $loginChecker = new CaptchaChecker($logger, $userData, $loginData);

        return $loginChecker->isCaptchaNeeded(true);
    }

    protected function getLogger($loggerData)
    {
        echo json_encode($loggerData);
        $logger = new Logger();

        foreach ($loggerData as $key => $loggerDataKey)
        {
            $logger->logAttempt($key, $loggerDataKey);
        }

        return $logger;
    }

    protected function getUserDataMock($loginName, $ipCountry, $registrationIp)
    {
        $userDataMock = $this->getMockBuilder('Kata\\VelocityChecker\\UserData')->disableOriginalConstructor()->getMock();
        $userDataMock->expects($this->any())->method('getLoginName')->willReturn($loginName);
        $userDataMock->expects($this->any())->method('getIpCountry')->willReturn($ipCountry);
        $userDataMock->expects($this->any())->method('getRegistrationIp')->willReturn($registrationIp);

        return $userDataMock;
    }

    protected function getLoginDataMock($loginName, $ipCountry, $loginIp)
    {
        $loginDataMock = $this->getMockBuilder('Kata\\VelocityChecker\\LoginData')->disableOriginalConstructor()->getMock();
        $loginDataMock->expects($this->any())->method('getLoginName')->willReturn($loginName);
        $loginDataMock->expects($this->any())->method('getIpCountry')->willReturn($ipCountry);
        $loginDataMock->expects($this->any())->method('getLoginIp')->willReturn($loginIp);

        return $loginDataMock;
    }

    /**
     * @dataProvider noCaptchaNeededDataProvider
     *
     * @param $loggerData
     * @param $userData
     * @param $loginData
     */
    public function testNoCaptchaNeeded($loggerData, $userData, $loginData)
    {
        $logger          = $this->getLogger($loggerData);
        $isCaptchaNeeded = $this->getIsCaptchaNeeded($logger, $userData, $loginData);

        $this->assertFalse($isCaptchaNeeded);
    }

    public function noCaptchaNeededDataProvider()
    {
        $loggerData = array();
        $userData   = $this->getUserDataMock('ezmegaz', 'US' , '192.168.1.1');
        $loginData  = $this->getLoginDataMock('ezmegazus', 'US' , '192.168.1.4');


        return array(
            array($loggerData, $userData, $loginData, 1),
            array($loggerData, $userData, $loginData, 2),
        );
    }

    /**
     * @dataProvider captchaNeededDataProvider
     *
     * @param $loggerData
     * @param $userData
     * @param $loginData
     */
    public function testCaptchaNeeded($loggerData, $userData, $loginData)
    {
        $logger          = $this->getLogger($loggerData);
        $isCaptchaNeeded = $this->getIsCaptchaNeeded($logger, $userData, $loginData);

        $this->assertTrue($isCaptchaNeeded);
    }

    public function captchaNeededDataProvider()
    {
        $userData   = $this->getUserDataMock('ezmegaz', 'US' , '192.168.1.1');
        $loginData  = $this->getLoginDataMock('ezmegazus', 'US' , '192.168.1.4');

        return array(
            array(array('192.168.1.1' => 2), $userData, $loginData, 1),
            array(array('ezmegaz' => 2) ,$userData, $loginData),
            array(array('192.168.1.X' => 499), $userData, $loginData),
            array(array('US' => 999), $userData, $loginData),
            array(array(), $userData, $this->getLoginDataMock('ezmegazus', 'NA' , '192.168.1.4') ,1),
        );
    }
}

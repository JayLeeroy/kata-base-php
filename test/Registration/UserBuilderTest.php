<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.11.19.
 * Time: 21:45
 */

namespace Kata\Test\Registration;

use Kata\Registration\UserBuilder;
use Kata\Registration\User;
use Kata\Registration\Request;

class UserBuilderTest extends \PHPUnit_Framework_TestCase {
    protected $userBuilder;

    protected function setUp()
    {
        $this->userBuilder       = new UserBuilder();
    }

    protected function callBuildUserWithMockedGenerator(Request $request, $generatedPassword = 'testGeneratedPassword')
    {
        $generator = $this->getMockBuilder('Kata\\Registration\\Generator')->disableOriginalConstructor()->getMock();
        $generator->expects($this->any())->method('generatePassword')->willReturn($generatedPassword);
        return $this->userBuilder->buildUser($request, $generator);
    }

    /**
     * @dataProvider requestWithUserNameAndPasswordProvider
     * @param Request $request
     */
    public function testBuildUserFromRequestWithUserNameAndPassword(Request $request)
    {
        /** @var User $user */
        $user = $this->callBuildUserWithMockedGenerator($request);

        $this->assertEquals($user->getUserName(), $request->userName, 'Username not equals');
        $this->assertEquals($user->getPlainPassword(), $request->password ,'Plain password not equals');
        $this->assertEquals($user->getPasswordHash(), md5(UserBuilder::SALT . $request->password),'Hashed password not equals');
    }

    public function requestWithUserNameAndPasswordProvider()
    {
        return array(
            array($this->requestGenerator('Testuser', 'Testpassword')),
            array($this->requestGenerator('Testuser1234', 'Testuser1234')),
        );
    }

    /**
     * @dataProvider requestWithUserNameProvider
     * @param Request $request
     * @param string $generatedPassword
     */
    public function testBuildUserFromRequestWithUserName(Request $request, $generatedPassword)
    {
        /** @var User $user */
        $user = $this->callBuildUserWithMockedGenerator($request , $generatedPassword);

        $this->assertEquals($user->getUserName(), $request->userName, 'Username not equals');
        $this->assertEquals($user->getPlainPassword(), $generatedPassword ,'Plain password not equals');
        $this->assertEquals($user->getPasswordHash(), md5(UserBuilder::SALT . $generatedPassword),'Hashed password not equals');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildUserFromRequestWithoutUserName()
    {
        $this->callBuildUserWithMockedGenerator(new Request());
    }

    public function requestWithUserNameProvider()
    {
        return array(
            array($this->requestGenerator('Testuser'), 'Testpassword'),
            array($this->requestGenerator('Testuser1234'), 'Testuser1234'),
        );
    }

    protected function requestGenerator($userName = '', $password = '', $passwordConfirm = '')
    {
        $request = new Request();
        $request->userName = $userName;
        $request->password = $password;
        $request->passwordConfirm = $passwordConfirm;

        return $request;
    }
}

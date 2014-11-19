<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.11.19.
 * Time: 21:45
 */

namespace Kata\Test\Registration;

use Kata\Registration\Validator;
use Kata\Registration\Request;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

    const VALID_CHARACTERS = '0123456789abcdefghijklmnopqrstuvwxyz';

    /**
     * @var Validator
     */
    protected $validator;

    protected function setUp()
    {
        $this->validator       = new Validator();
    }

    /**
     * @dataProvider validUserNameRequestProvider
     * @param Request $request
     */
    public function testValidUserName(Request $request)
    {
        $isValidUserName = $this->validator->isValidUserName($request);

        $this->assertTrue($isValidUserName);
    }

    /**
     * @dataProvider validPasswordRequestProvider
     * @param Request $request
     */
    public function testValidPassword(Request $request)
    {
        $isValidPassword = $this->validator->isValidPassword($request);

        $this->assertTrue($isValidPassword);
    }

    /**
     * @dataProvider invalidUserNameRequestProvider
     * @param Request $request
     */
    public function testInvalidUserName(Request $request)
    {
        $isValidUserName = $this->validator->isValidUserName($request);

        $this->assertFalse($isValidUserName);
    }

    /**
     * @dataProvider invalidPasswordRequestProvider
     * @param Request $request
     */
    public function testInValidPassword(Request $request)
    {
        $isValidPassword = $this->validator->isValidPassword($request);

        $this->assertFalse($isValidPassword);
    }

    public function validUserNameRequestProvider()
    {
        return array(
            array($this->requestGenerator(str_pad('' ,4 , self::VALID_CHARACTERS))),
            array($this->requestGenerator(str_pad('' ,16 , self::VALID_CHARACTERS))),
            array($this->requestGenerator(str_pad('' ,128 , self::VALID_CHARACTERS)))
        );
    }

    public function invalidUserNameRequestProvider()
    {
        return array(
            array($this->requestGenerator(str_pad('' ,3 , self::VALID_CHARACTERS))),
            array($this->requestGenerator(str_pad('' ,129 , self::VALID_CHARACTERS))),
            array($this->requestGenerator(str_pad('' ,5 , '@$d')))
        );
    }

    public function validPasswordRequestProvider()
    {
        return array(
            array($this->requestGenerator('', '123456', '123456')),
            array($this->requestGenerator('', '123456abcdefg', '123456abcdefg')),
        );
    }

    public function invalidPasswordRequestProvider()
    {
        return array(
            array($this->requestGenerator('', 'password', 'anotherpassword')),
            array($this->requestGenerator('', '12345', '12345')),
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

<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.11.19.
 * Time: 21:45
 */

namespace Kata\Test\Registration;

use Kata\Registration\Generator;

class GeneratorTest extends \PHPUnit_Framework_TestCase {
    public function testGeneratedPasswords()
    {
        $generator = new  Generator();
        $oldGeneratedPassword = $generator->generatePassword();

        for ($i = 0; $i < 25; $i++) {
            $newGeneratedPassword = $generator->generatePassword();
            $this->assertNotEquals($oldGeneratedPassword,  $newGeneratedPassword);
        }
    }
}

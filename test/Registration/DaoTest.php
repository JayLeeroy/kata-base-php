<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.11.19.
 * Time: 21:45
 */

namespace Kata\Test\Registration;

use Kata\Registration\User;
use Kata\Registration\Dao;

class DaoTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \Pdo
     */
    protected static $pdo;

    /**
     * @var Dao
     */
    protected $dao;

    public static function setUpBeforeClass()
    {
        $dsn = sprintf("sqlite:%s", '././test_useres.db');
        self::$pdo = new \PDO($dsn);
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $sth = self::$pdo->prepare("
             CREATE TABLE users (
         id INTEGER PRIMARY KEY   AUTOINCREMENT,
         username VARCHAR(128) NOT NULL UNIQUE,
         password_hash VARCHAR(64) NOT NULL);"
        );
        $sth->execute();
    }

    public function setUp()
    {
        $sth = self::$pdo->prepare("DELETE FROM users");
        $sth->execute();
        $sth = self::$pdo->prepare("
          INSERT INTO users (username, password_hash)
          VALUES
          ('34rf345t455gf45g45', 'dadd8ad8a8df7a8d7a'),
          ('eqeqeqeq', 'dd24d3d34d34d234d23')
        ");
        $sth->execute();

        $this->dao = new Dao();
    }

    /**
     * @dataProvider newUserProvider
     * @param User $user
     */
    public function testInsertNewUser(User $user)
    {
        $id = $this->dao->storeUserData(self::$pdo, $user);
        $this->assertNotEmpty($id);
    }

    public function newUserProvider()
    {
        return array(
            array(new User('aaaaaaaaaa', '111111111111', 'dadd8ad8a8df7a8d7a')),
            array(new User('bbbbbbbbbbbb', '2314f1f41f14f3124', 'dd24d3d34d34d234d23')),
            array(new User('ccccccccccccc', 'adaadsasdasd233333', 'asdasd3323r2r2j56hh567h')),
        );
    }

    /**
     * @dataProvider existingUserProvider
     * @param User $user
     */
    public function testInsertedUserAlreadyExist(User $user)
    {
        $id = $this->dao->storeUserData(self::$pdo, $user);
        $this->assertEmpty($id, $id);
    }

    public function existingUserProvider()
    {
        return array(
            array(new User('34rf345t455gf45g45', 'eqeqeqeq', 'dadd8ad8a8df7a8d7a')),
            array(new User('eqeqeqeq', '34rf345t455gf45g45', 'dd24d3d34d34d234d23')),
        );
    }

    public static function tearDownAfterClass()
    {
        $sth = self::$pdo->prepare("DROP TABLE IF EXISTS users");
        $sth->execute();
    }
}

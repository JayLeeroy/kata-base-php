<?php

namespace Kata\Test\VelocityChecker;

use Kata\VelocityChecker\SQLite;
use Kata\VelocityChecker\DatabaseInterface;

class SQLiteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SQLite
     */
    protected $dbConnection;

    protected function setUp()
    {
        $this->dbConnection = new SQLite();
        $query = $this->dbConnection->prepare("CREATE TABLE IF NOT EXISTS login_attempt (attempt_from TEXT, type TEXT, count INTEGER)");
        $query->execute();
    }

    public function testConnection()
    {
        $query = $this->dbConnection->prepare("SELECT * from login_attempt");

        $a = $query->execute();

        $this->assertTrue($a);
    }

    public function testInsertConnection()
    {
        $insertQuery = $this->dbConnection->prepare("INSERT INTO login_attempt VALUES ('192.168.1.5' , 'ip' , 2)");

        $insertQuery->execute();

        $query = $this->dbConnection->prepare("SELECT * from login_attempt");

        $query->execute();

        $queryResult = $query->fetch(\PDO::FETCH_ASSOC);

        $this->assertEquals($queryResult, array('attempt_from'=> '192.168.1.5' , 'type' => 'ip' , 'count' => 2));
    }

    public function tearDown()
    {
        $query = $this->dbConnection->prepare("DROP TABLE login_attempt");
        $query->execute();
    }
}

<?php


namespace Kata\VelocityChecker;

class SQLite implements DatabaseInterface
{

    private $databaseFileName = "velocitychecker.sqlite3";
    private $databaseConnection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->databaseConnection = new \PDO('sqlite:' . $this->databaseFileName);
        $this->databaseConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function exec($statement)
    {
        return $this->databaseConnection->exec($statement);
    }

    public function prepare($statement)
    {
        return $this->databaseConnection->prepare($statement);
    }
}
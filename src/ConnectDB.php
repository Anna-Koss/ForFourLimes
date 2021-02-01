<?php


namespace App;


class ConnectDB
{
    private const DB_NAME = 'test_db';
    private const HOST = 'mysql';
    private const LOGIN = 'anna';
    private const PASS = 'pass';
    private $pdo;

    public function connect()
    {
        $mode = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $this->pdo = new \PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME, self::LOGIN, self::PASS, $mode);
        return $this->pdo;
    }

    public function __destruct()
    {
        $this->pdo = NULL;
    }

}
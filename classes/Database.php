<?php

class Database
{
    protected $connection;

    public function __construct($dsn, $username = 'root', $password = '')
    {
        $dsn = "mysql:" . http_build_query($dsn, '', ';');
        $this->connection = new PDO($dsn, $username, $password);
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
    }
}

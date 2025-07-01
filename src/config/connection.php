<?php

use Dom\Mysql;

include __DIR__ . '/db.php';

function db_connection()
{
    $dbname = MYSQL['dbname'];
    $port = MYSQL['port'];
    $host = MYSQL['host'];
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, MYSQL['username'], MYSQL['password']);
    return $pdo;
}

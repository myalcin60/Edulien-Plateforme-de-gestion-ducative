<?php
include __DIR__ . '/db.php';

function db_connection()
{
    $host = MYSQL['host'];
    $port = MYSQL['port'];
    $dbname = MYSQL['dbname'];
    
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, MYSQL['username'], MYSQL['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

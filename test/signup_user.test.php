<?php 
include __DIR__. '/../src/config/connection.php';
function test_insert() {
    $pdo = db_connection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO users (id, first_name, last_name, email, password, role)
            VALUES ('T_999999', 'Test', 'User', 'test999@test.com', '12345', 'teacher')";
    $pdo->exec($sql);
}

<?php
require_once __DIR__ . '/../config/connection.php';


function get_user_with_token(string $token) {
    $pdo = db_connection();
    $stmt = $pdo->prepare("
        SELECT * FROM users 
        WHERE email_verify_token = :token
    ");
    $stmt->bindValue(':token', $token);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function clear_token(string $token) {
    $pdo = db_connection();
    $stmt = $pdo->prepare("
        UPDATE users  
        SET email_verify_token = NULL,
            email_verify_created_at = NULL,
            email_verified = 0 
        WHERE email_verify_token = :token
    ");
    $stmt->bindValue(':token', $token);
    $stmt->execute();
}

function add_token(string $email, string $token) {
    $pdo = db_connection();
    $stmt = $pdo->prepare("
        UPDATE users 
        SET email_verify_token = :token,
            email_verify_created_at = NOW()
        WHERE email = :email
    ");
    $stmt->bindValue(':token', $token);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
}

function verify_token($token){
    $pdo = db_connection();
    $update = $pdo->prepare("
        UPDATE users 
        SET email_verified = 1,
            email_verify_created_at = NULL
         WHERE email_verify_token = :token
    ");
    $update->bindValue(':token', $token);
    $update->execute();
}


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

// function verify_email_token(string $token) {
//     $pdo = db_connection();

//     // 1️⃣ Token ile kullanıcıyı bul (email_verified durumu sorguda yok)
//     $stmt = $pdo->prepare("
//         SELECT * FROM users 
//         WHERE email_verify_token = :token
//     ");
//     $stmt->bindValue(':token', $token);
//     $stmt->execute();
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

    

//     // 2️⃣ Token süresi kontrolü (email_verify_created_at)
//     $createdAt = strtotime($user['email_verify_created_at']);
//     $now = time();

//     // 24 saat = 86400 saniye (test için küçük değer kullanılabilir)
//     if (($createdAt - $now) > 5) {
//         // Token süresi doldu → temizle
//         $clear = $pdo->prepare("
//             UPDATE users  
//             SET email_verify_token = NULL,
//                 email_verify_created_at = NULL,
//                 email_verified = 0 
//             WHERE id = :id
//         ");
//         $clear->bindValue(':id', $user['id']);
//         $clear->execute();

//         $_SESSION['resend_email'] = $user['email'];

//         $_SESSION['error'] = 'Verification link expired. Please request a new one.';
//         header("Location: ../../views/pages/auth.php");
//         exit;
//     }

//     if (!$user) {
//         // Token yok veya zaten kullanılmış
//         $_SESSION['error'] = 'Invalid or used token.';
//         header("Location: ../../views/pages/auth.php");
//         exit;
//     }

//     // 3️⃣ Token geçerli → kullanıcı zaten doğrulanmış mı kontrol et
//     if ($user['email_verified'] == 1) {
//         $_SESSION['error'] = 'Email already verified. You can log in.';
//         header("Location: ../../views/pages/auth.php?form=login");
//         exit;
//     }

//     // 4️⃣ Token geçerli ve kullanıcı doğrulanmamış → doğrula
//     $update = $pdo->prepare("
//         UPDATE users 
//         SET email_verified = 1,
//             email_verify_token = NULL,
//             email_verify_created_at = NULL
//         WHERE id = :id
//     ");
//     $update->bindValue(':id', $user['id']);
//     $update->execute();

//     $_SESSION['success'] = 'Email verified! You can log in now.';
//     header("Location: ../../views/pages/auth.php?form=login");
//     exit;
// }

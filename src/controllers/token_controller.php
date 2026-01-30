<?php
session_start();
require_once __DIR__ . '/../repositories/token_repository.php';
require_once __DIR__ . '/../services/mail_services.php';

if (isset($_GET['token'])) {
    // $_SESSION['error'] = 'Verification link expired or token is missing.';
    // header("Location: ../../views/pages/auth.php");
    // exit;

    // $token = $_GET['token'];
    // verify_email_token($token);

    $token = $_GET['token'];

    $user = get_user_with_token($token);
    $_SESSION['email'] = $user['email'];

    // 3️⃣ Token geçerli → kullanıcı zaten doğrulanmış mı kontrol et
    if ($user['email_verified'] == 1) {
        $_SESSION['error'] = 'Email already verified. You can log in.';
        header("Location: ../../views/pages/auth.php?form=login");
        exit;
    }

    // Token yok veya zaten kullanılmış
    if (!$user) {
        $_SESSION['error'] = 'Invalid or used token. Please fill out the form again.';
        header("Location: ../../views/pages/auth.php");
        exit;
    }

    // token time control
    $createdAt = strtotime($user['email_verify_created_at']);
    $now = time();
    if ($createdAt - $now > 86400) {
        clear_token($token);
        $_SESSION['error'] = 'Verification link expired. Please request a new token.';
        header("Location: ../../views/pages/auth.php");
        exit;
    }

    if ($user && $user['email_verified'] == 0) {
        verify_token($token);
        $_SESSION['success'] = 'Email verified! You can log in now.';
        header("Location: ../../views/pages/auth.php?form=login");
        die();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $email = $_POST['email'];
   
    if ($action === 'resend_token') {
        $token = bin2hex(random_bytes(32));
        add_token($email, $token);
        MailService::sendVerificationEmail($email, $token);
        $_SESSION['success'] = 'Please verify your email address to log in..';
        header("location: ../../views/pages/auth.php?form=login");
        exit;
    }
}

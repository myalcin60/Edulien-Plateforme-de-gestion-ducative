<?php

// PHPMailer ve MailService dahil et
require_once __DIR__ . '../../lips/PHPMailer/src/Exception.php';
require_once __DIR__ . '../../lips/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '../../lips/PHPMailer/src/SMTP.php';
require_once __DIR__ . '../../src/services/mail_services.php';

// Test email ve token
$email = 'coduer@yopmail.com'; // Mailtrap veya gerçek test maili
$token = bin2hex(random_bytes(16));

// Gönder
try {
    MailService::sendVerificationEmail($email, $token);
    echo "Mail gönderildi!";
} catch (Exception $e) {
    echo "Hata: " . $e->getMessage();
}

<?php

require_once __DIR__ . '/lips/PHPMailer/src/Exception.php';
require_once __DIR__ . '/lips/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/lips/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/src/services/mail_services.php';


// yönlendirme
header("Location: views/pages/index.php");
exit();
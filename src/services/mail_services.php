<?php
require_once __DIR__ . '/../../lips/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../../lips/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../lips/PHPMailer/src/SMTP.php';

class MailService
{
    public static function sendVerificationEmail(string $email, string $token)
    {
        if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'localhost') {
            return $verifyLink = "https://edulien.free.nf/src/controllers/token_controller.php?token=" . $token;;
        } else {
            return $verifyLink = "http://localhost/edu_php/src/controllers/token_controller.php?token=" . $token;
;
        }
   

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        // UTF-8 karakter seti
        $mail->CharSet = 'UTF-8';

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yalcinmusa60@gmail.com';   // Gmail adresin
        $mail->Password = 'kbvqlbyzdabvdcvr';       // Gmail App Password (boşluksuz)
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('no-reply@edulien.com', 'Edulien');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Edulien Email Verification';
        $mail->Body = '
        <div style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
            <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 30px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <h2 style="color: #333333;">Welcome to Edulien!</h2>
                <p style="color: #555555; font-size: 16px;">Please click the button below to verify your email address:</p>
                     <a href="' . $verifyLink . '" 
                         style="display: inline-block; padding: 12px 25px; margin-top: 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                      Verify My Email
                    </a>
                <p style="color: #999999; font-size: 12px; margin-top: 20px;">This link is valid for 24 hours.</p>
            </div>
        </div>
';
        $mail->send();
    }

    public static function sendResetPasswordEmail(string $email, string $token)
    {
          if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'localhost') {
            return $verifyLink = "https://edulien.free.nf/views/pages/new_password?&token=" . $token;
        } else {
            return $verifyLink = "http://localhost/edu_php/views/pages/new_password?&token=" . $token;
;
        }
      

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        // UTF-8 karakter seti
        $mail->CharSet = 'UTF-8';

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yalcinmusa60@gmail.com';   // Gmail adresin
        $mail->Password = 'kbvqlbyzdabvdcvr';       // Gmail App Password (boşluksuz)
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('no-reply@edulien.com', 'Edulien');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Edulien password reset';
        $mail->Body = '
        <div style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
            <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 30px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <h2 style="color: #333333;">Welcome to Edulien!</h2>
                <p style="color: #555555; font-size: 16px;">Please click the button below to verify your email address:</p>
                     <a href="' . $verifyLink . '" 
                         style="display: inline-block; padding: 12px 25px; margin-top: 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                      Verify My Email
                    </a>
                <p style="color: #999999; font-size: 12px; margin-top: 20px;">This link is valid for 24 hours.</p>
            </div>
        </div>
';
        $mail->send();
    }
}

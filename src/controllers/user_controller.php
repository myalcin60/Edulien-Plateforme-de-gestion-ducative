<?php
session_start();
include __DIR__ . '/../repositories/user_repository.php';
include __DIR__ . '/../services/service.php';
include_once __DIR__ . '/../../views/partiel/toast.php';
include_once __DIR__ . '/../services/mail_services.php';

$id = '';
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

   $action = $_POST['action'] ?? null;
   switch ($action) {
      // SIGNUP 
      case 'signup':
         $role = $_POST['role'];
         $id = create_id($role);
         $firstname = ucfirst(strtolower($_POST['firstname']));
         $lastname  = strtoupper($_POST['lastname']);
         $email     = $_POST['email'];
         $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);


         if ($firstname == "" || $lastname == "" || $email == "" || $password == "") {
            $_SESSION['error'] = 'All fields are required';
            header("location: ../../views/pages/auth.php");
            exit;
         }
         $user = get_user_by_email($email);
         if ($user) {
            $_SESSION['error'] = 'This email already exists';
            header("location: ../../views/pages/auth.php");
            exit;
         }

         $token = bin2hex(random_bytes(32));

         signup_user($id, $firstname, $lastname, $email, $password, $role, $token);

         MailService::sendVerificationEmail($email, $token);

         $_SESSION['success'] = 'Registration successful! Please verify your email address to log in..';
         header("location: ../../views/pages/auth.php?form=login");
         exit;
         // LOGIN
      case 'login':
         $email    = $_POST['email'];
         $password = $_POST['password'];
         $user = get_user_by_email($email);
        

         if (!$user) {
            $_SESSION['error'] = 'Email is incorrect';
            header("location: ../../views/pages/auth.php?form=login");
            exit;
         }
         if ($user && password_verify($password, $user['password'])) {

            if ($user['email_verified'] == 0) {
               $_SESSION['error'] = 'You need to verify your email address. Please check your inbox.';
               header("Location: ../../views/pages/auth.php");
               exit;
            }
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name']  = $user['last_name'];
            $_SESSION['email']      = $user['email'];
            $_SESSION['role']       = $user['role'];
            $_SESSION['id']         = $user['id'];
            if ($user['role'] === 'teacher') {
               $_SESSION['success'] = 'Login successful! ' . $user['first_name'];
               header("location: ../../views/pages/teacher_dashboard.php");
               exit;
            }
            $_SESSION['success'] = 'Login successful! ' . $user['first_name'];
            header("location: ../../views/pages/student_dashboard.php");
            exit;
         }
         $_SESSION['error'] = 'Email or password is incorrect';
         header("location: ../../views/pages/auth.php?form=login");
         exit;
         // logout
      case 'logout':
         session_unset();
         session_destroy();
         $_SESSION['success'] = 'Logout successful ! ';
         header("location: ../../views/pages/auth.php?form=login");
         die();
      // reset password   
      case 'reset_password':
         $email = $_POST['email'];
         $user = get_user_by_email($email);
        
         if (!$user) {
            $_SESSION['error'] = 'Email does not exist';
            header("location: ../../views/pages/update_password.php");
            exit;
         }

         $_SESSION['email'] = $email;
         $token = bin2hex(random_bytes(32));
         MailService::sendResetPasswordEmail($email, $token);
         $_SESSION['success'] = 'A password reset link has been sent to your email address.';
         header("location: ../../views/pages/auth.php?form=login");  
         exit;
      case 'new_password':
         if ($_POST['password'] !== $_POST['password_confirm']) {
            $_SESSION['error'] = 'Passwords do not match';
            header("location: ../../views/pages/new_password.php");
            exit;
         }
         if (strlen($_POST['password']) < 4) {
            $_SESSION['error'] = 'Password must be at least 6 characters long';
            header("location: ../../views/pages/new_password.php");
            exit;
         }
         $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
         $email = $_SESSION['email'];
         update_user_password($email, $password);
         unset($_SESSION['email']);
         $_SESSION['success'] = 'Password updated successfully! You can now log in with your new password.';
         header("location: ../../views/pages/auth.php?form=login");
         exit;

      // DEFAULT 
      default:
         $_SESSION['error'] = 'Invalid action';
         header("location: ../../views/pages/auth.php");
         exit;
   }
} else {
   $_SESSION['error'] = 'Invalid request';
   header("location: ../../views/pages/auth.php");
   exit;
}

<?php
session_start();
include __DIR__ . '/../repositories/user_repository.php';
include __DIR__ . '/../services/service.php';
include_once __DIR__ . '/../../views/partiel/toast.php';


$id = '';
// Signup 
//  if (str_contains($_SERVER['HTTP_REFERER'], 'main') and $_SERVER['REQUEST_METHOD'] === 'POST')
if (
   $_SERVER['REQUEST_METHOD'] === 'POST' &&
   isset($_POST['source']) &&
   $_POST['source'] === 'main'
) {

   $role = $_POST['role'];
   $id = create_id($role);
   $firstname = $_POST['firstname'];
   $lastname =strtoupper( $_POST['lastname']);
   $email = $_POST['email'];

   $password = password_hash($_POST['password'],PASSWORD_DEFAULT);


   $user = get_user_by_email($email);

   if ($user) {
       $_SESSION['error'] = 'This email already exists';
      header("location: ../../views/pages/main.php");
      die();
   } else {
      signup_user($id, $firstname, $lastname, $email, $password, $role);
       $_SESSION['success'] = 'Registration successful! You can log in.';

      header("location: ../../views/pages/main.php?form=login");
      die();
   }

}

//login
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "main") and $_SERVER['REQUEST_METHOD'] === 'GET') {
   $email = $_GET['email'];
   $password = $_GET['password'];

   $user = get_user($email);

   if ($user && password_verify($password,$user['password'])) {

      $_SESSION['first_name'] = $user['first_name'];
      $_SESSION['last_name'] = $user['last_name'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['id'] = $user['id'];
      $id = $user['id'];

      $_SESSION['toast'] = [
         'type' => 'success',
         'message' => 'Login successful ! ' . $user['first_name']
      ];

      if ($id) {
         if ($id[0] == 'T') {
            header("location: ../../views/pages/teacher_dashboard.php");
            die();
         } else {
            header("location: ../../views/pages/student_dashboard.php");
            die();
         }
      }
   } else {
      $_SESSION['toast'] = [
         'type' => 'error',
         'message' => 'Error email or password!'
      ];
      var_dump($_SESSION['toast']);


      header("location: ../../views/pages/main.php?form=login");
   }
}

// logout 
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
   session_unset();
   session_destroy();

   $_SESSION['toast'] = [
      'type' => 'info',
      'message' => 'Log out'
   ];
   header("location: ../../views/pages/main.php?form=login");
   die();
}




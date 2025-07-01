<?php
session_start();
include __DIR__ . '/../repositories/user_repository.php';
include __DIR__ . '/../services/service.php';

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
   $lastname = $_POST['lastname'];
   $email = $_POST['email'];
   $password = $_POST['password'];

   signup_user($id, $firstname, $lastname, $email, $password, $role);

   header("location: ../../views/pages/main.php");
   die();
}

//login
if ( isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "main") and $_SERVER['REQUEST_METHOD'] === 'GET') {
   $email = $_GET['email'];
   $password = $_GET['password'];

   $user = get_user($email, $password);

   $_SESSION['first_name'] = $user['first_name'];
   $_SESSION['last_name'] = $user['last_name'];
   $_SESSION['email'] = $user['email'];
   $_SESSION['role'] = $user['role'];
   $_SESSION['id'] = $user['id'];

   $id = $user['id'];
   if ($id[0] == 'T') {
      header("location: ../../views/pages/teacher_dashboard.php");
      die();
   } else {
      header("location: ../../views/pages/student_dashboard.php");
      die();
   }
}
// apres logout teacher
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "teacher_dashboard") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   session_unset();
   session_destroy();
   header("location: ../../views/pages/main.php?form=login");
   die();
}
// apres logout studnet
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'],  "student_dashboard") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   session_unset();
   session_destroy();
   header("location: ../../views/pages/main.php?form=login");
   die();
}



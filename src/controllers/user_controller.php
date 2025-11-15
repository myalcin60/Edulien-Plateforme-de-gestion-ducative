<?php
session_start();
include __DIR__ . '/../repositories/user_repository.php';
include __DIR__ . '/../services/service.php';
include_once __DIR__ . '/../../views/partiel/toast.php';


$id = '';
// Signup 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['source']) && $_POST['source'] === 'main') {

   $role = $_POST['role'];
   $id = create_id($role);
  $firstname = ucfirst(strtolower($_POST['firstname']));
   $lastname = strtoupper($_POST['lastname']);
   $email = $_POST['email'];

   $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


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

   $user = get_user_by_email($email);


   if ($user && password_verify($password, $user['password'])) {

      $_SESSION['first_name'] = $user['first_name'];
      $_SESSION['last_name'] = $user['last_name'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['id'] = $user['id'];
      $id = $user['id'];
          
         if ($id[0] == 'T') {
            header("location: ../../views/pages/teacher_dashboard.php");
            $_SESSION['success'] = 'Login successful ! ' . $user['first_name'];
            die();
         } else {
            header("location: ../../views/pages/student_dashboard.php");
            $_SESSION['success'] = 'Login successful ! ' . $user['first_name'];
            die();
         }      
   } 
   else {
      header("location: ../../views/pages/main.php?form=login");
      $_SESSION['error'] = 'Email or password is incorrect';
      die();
   }
}

// logout 
if (isset($_POST['action']) && $_POST['action'] === 'logout') {
   session_unset();
   session_destroy();
   $_SESSION['success'] = 'Logout successful ! ';
   header("location: ../../views/pages/main.php?form=login");
   die();

}

// uplaod photo
if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
   $tmpName = $_FILES['profile_photo']['tmp_name'];
   $fileContent = file_get_contents($tmpName);
   $fileType = $_FILES['profile_photo']['type']; // örn: image/jpeg

   $userId = $_POST['userId'];

   uplad_user_photo($userId, $fileContent, $fileType);
   $_SESSION['success'] =  "Photo uploaded successfully!";
   header("location: ../../views/pages/teacher_dashboard.php?form=profile");
   die();
} else {
   $_SESSION['error'] = "Photo could not be uploaded!";
   header("location: ../../views/pages/teacher_dashboard.php?form=profile");
   die();
}


  
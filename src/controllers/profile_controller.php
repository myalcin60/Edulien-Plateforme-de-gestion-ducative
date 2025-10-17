<?php
session_start();
include __DIR__ . '/../repositories/user_repository.php';
include __DIR__ . '/../services/service.php';
include_once __DIR__ . '/../../views/partiel/toast.php';

// update profole
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "dashboard.php") and $_SERVER['REQUEST_METHOD'] === 'POST') {
//  echo $_POST['specialization'];
   
    update_user_profile($_POST['id'], $_POST['email'], trim($_POST['first_name']), trim($_POST['last_name']), $_POST['gender'], trim($_POST['specialization']));
    if ($_POST['id'][0] == 'T') {
      $_SESSION['success'] =  "Profile uploaded successfully!";
      header("location: ../../views/pages/teacher_dashboard.php?form=profile");
      die();
    } else {
      $_SESSION['success'] =  "Profile uploaded successfully!";
      header("location: ../../views/pages/student_dashboard.php?form=profile");
      die();
    }
  
}
// delete user
if(isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "dashboard.php") and $_SERVER['REQUEST_METHOD'] === 'GET') {
   echo "here";
   $userId = $_SESSION['id'];
   echo $userId;
   delete_user($userId);
   session_unset();
   session_destroy();
   header("location: ../../views/pages/index.php");
   die();
}

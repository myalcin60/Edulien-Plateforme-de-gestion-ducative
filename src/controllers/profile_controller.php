<?php
session_start();
include __DIR__ . '/../repositories/user_repository.php';
include __DIR__ . '/../services/service.php';
include_once __DIR__ . '/../../views/partiel/toast.php';

if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? null;
  switch ($action) {
    case 'update_photo':
      if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['profile_photo']['tmp_name'];
        $fileContent = file_get_contents($tmpName);
        $fileType = $_FILES['profile_photo']['type'];

        $userId = $_POST['userId'];

        uplad_user_photo($userId, $fileContent, $fileType);
        if ($_POST['userId'][0] == 'T') {
          $_SESSION['success'] =  "Photo uploaded successfully!";
          header("location: ../../views/pages/teacher_dashboard.php?form=profile");
          die();
        } else {
          $_SESSION['success'] =  "Photo uploaded successfully!";
          header("location: ../../views/pages/student_dashboard.php?form=profile");
          die();
        }
    
      } else {
        if ($_POST['userId'][0] == 'T') {
          $_SESSION['error'] = "Photo could not be uploaded!";
          header("location: ../../views/pages/teacher_dashboard.php?form=profile");
          die();
        }
        $_SESSION['error'] = "Photo could not be uploaded!";
        header("location: ../../views/pages/student_dashboard.php?form=profile");
        die();
      }
      break;
    case 'update_profile':
        $firstname = ucfirst(strtolower(trim($_POST['first_name'])));
         $lastname  = strtoupper(trim($_POST['last_name']));
         $email     = trim($_POST['email']);
         $specialization = ucfirst(strtolower(trim($_POST['specialization'])));
         
      if ($firstname == "" || $lastname == "" || $email == "" || $specialization == "") { 
        if ($_POST['id'][0] == 'T') {
          $_SESSION['error'] = 'All fields are required';
          header("location: ../../views/pages/teacher_dashboard.php?form=profile");
          die();
        } else {
           $_SESSION['error'] = "All fields are required!";
          header("location: ../../views/pages/student_dashboard.php?form=profile");
          die();
        }
      }
      update_user_profile($_POST['id'], $email, $firstname, $lastname, $_POST['gender'], $specialization);
      if ($_POST['id'][0] == 'T') {
        $_SESSION['success'] =  "Profile uploaded successfully!";
        header("location: ../../views/pages/teacher_dashboard.php?form=profile");
        die();
      } else {
        $_SESSION['success'] =  "Profile uploaded successfully!";
        header("location: ../../views/pages/student_dashboard.php?form=profile");
        die();
      }
    case 'delete_profile':
      $userId = $_SESSION['id'];
      delete_user($userId);
      session_unset();
      session_destroy();
      header("location: ../../views/pages/index.php");
      die();
  }
}

<?php
session_start();
include __DIR__ . '/../repositories/class_repository.php';

// creat class
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "form=classes") and $_SERVER['REQUEST_METHOD'] === 'POST') {
   $className = $_POST['class_name'];
   $userid = $_SESSION['id'];

   $classes = get_classes($userid);
   
   $list=[];
   foreach ($classes as $class) {
      $list[]=$class[1];
   
   }
    var_dump($list);
   if (in_array(strtolower($className), array_map('strtolower', $list))) {
      $_SESSION['error'] = 'This class already exists !!';
      header("location: ../../views/pages/teacher_dashboard.php?form=classes");
      die();
   } else {
      create_class($userid, $className);
      $_SESSION['success'] = 'Class created successfully.';
      header("location: ../../views/pages/teacher_dashboard.php?form=classes");
      die();
   }
}
//get class
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] === 'GET') {
   get_classes_for_student($_SESSION['id']);
   header("location: ../../views/pages/student_dashboard.php?form=classes");
   die();
}



//logout
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   session_unset();
   session_destroy();
   header("location: ../../views/pages/main.php?form=login");
   die();
}

// delete class
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "teacher_dashboard.php?form=classes") and $_SERVER['REQUEST_METHOD'] == 'GET') {
   delete_class($_GET['id']);
   header("location: ../../views/pages/teacher_dashboard.php?form=classes");
   die();
}

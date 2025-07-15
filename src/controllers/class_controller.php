<?php
session_start();
include __DIR__ . '/../repositories/class_repository.php';

// creat class
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "form=classes") and $_SERVER['REQUEST_METHOD'] === 'POST') {
   $className = $_POST['class_name'];
   create_class($_SESSION['id'], $className);
   header("location: ../../views/pages/teacher_dashboard.php?form=classes");
   die();

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



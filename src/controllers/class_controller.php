<?php
session_start();
include __DIR__ . '/../repositories/class_repository.php';
include __DIR__ . '/../services/service.php';

// creat class
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "form=classes") and $_SERVER['REQUEST_METHOD'] === 'POST') {
   $className = $_POST['class_name'];
   create_class($_SESSION['id'], $className);
    header("location: ../../views/pages/teacher_dashboard.php?form=classes");
   die();

}
//get clas
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] === 'GET') {
   get_classes_for_student($_SESSION['id']);
   header("location: ../../views/pages/student_dashboard.php?form=classes");
   die();
}


// add student
if (
    isset($_SERVER["HTTP_REFERER"]) &&
    str_contains($_SERVER['HTTP_REFERER'], 'class_page') &&
    $_SERVER['REQUEST_METHOD'] === 'POST'
)
{
   $email = $_POST['email'];
   $classId= $_POST['classId'];
   $student = get_student__from_users($email);
   
    add_student( $classId, $student['id'], $student['first_name'], $student['email']);
  
    header("location: ../../views/pages/class_page.php?id=$classId");
   die();
}
//logout
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   session_unset();
   session_destroy();
   header("location: ../../views/pages/main.php?form=login");
   die();
}
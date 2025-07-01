<?php
session_start();
include __DIR__ . '/../repositories/class_repository.php';
include __DIR__ . '/../services/service.php';

if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "form=classes") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   $className = $_POST['class_name'];
   create_class($_SESSION['id'], $className);

}

if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'GET') {
   $className = $_POST['class_name'];
   create_class($_SESSION['id'], $className);
   header("location: ../../views/pages/student_dashboard.php?form=classes");
   die();
}

if (isset($_SERVER["HTTP_REFERER"]) && str_contains($_SERVER['HTTP_REFERER'], 'class_page' && $_SERVER['REQUEST_METHOD'] == 'POST')) {
   $email = $_POST['email'];   
   $_SESSION['classId'] = $classId;
   $student = get_student($email);
   add_student($student[], $student[0], $student[1], $student[3]);
  
   header("location: ../../views/pages/class_page.php");
   die();
}

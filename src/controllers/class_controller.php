<?php
session_start();
include __DIR__ . '/../repositories/class_repository.php';
include __DIR__ . '/../services/service.php';


if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "form=classes") and $_SERVER['REQUEST_METHOD'] === 'POST') {
   $className = $_POST['class_name'];
   create_class($_SESSION['id'], $className);

}
// create clas
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] === 'GET') {
   $className = $_POST['class_name'];
   create_class($_SESSION['id'], $className);
   header("location: ../../views/pages/student_dashboard.php?form=classes");
   die();
}


// add student
if (isset($_SERVER["HTTP_REFERER"]) && str_contains($_SERVER['HTTP_REFERER'], 'class_page' && $_SERVER['REQUEST_METHOD'] === 'POST')) {
   

   $email = $_POST['email'];
   $classId= $_POST['classId'];

   var_dump( $email , $classId);

   $student = get_student__from_users($email);

   var_dump($student);

   echo $student[0];
   
   add_student( $classId, $student[0], $student[1], $student[3]);
  
   header("location: ../../views/pages/class_page.php?id=$classId");
   die();
}


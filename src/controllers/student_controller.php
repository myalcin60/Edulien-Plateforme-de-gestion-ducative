<?php
session_start();
include __DIR__ . '/../repositories/student_repository.php';

// delete student in a class
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'GET') {
   $classId = $_GET['classId'];
   $studentId = $_GET['studentId'];


   delete_student_in_class($classId, $studentId);

   header("location: ../../views/pages/class_page.php?id=$classId");
   die();
}
// add student
if (
   isset($_SERVER["HTTP_REFERER"]) &&
   str_contains($_SERVER['HTTP_REFERER'], 'class_page') &&
   $_SERVER['REQUEST_METHOD'] === 'POST'
) {
   $email = $_POST['email'];
   $classId = $_POST['classId'];

   if ($email == '') {
      $_SESSION['error'] = 'Please enter an email address';
      header("location: ../../views/pages/class_page.php?id=$classId");
      die();
   } else {
      $student = get_student__from_users($email);
      if ($student['id'] == null) {
         $_SESSION['error'] = 'This student is not exists !!';
         header("location: ../../views/pages/class_page.php?id=$classId");
         die();
      } 
      
      else {
         $result = get_student__from_students($email, $classId);
      }
   }


   if ($student['id'][0] != 'T') {
      if ($classId == $result['classId']) {
         $_SESSION['error'] = 'This student already exists !!';
         header("location: ../../views/pages/class_page.php?id=$classId");
         die();
      } else {
         add_student($classId, $student['id'], $student['first_name'], $student['email']);
         $_SESSION['success'] = 'Student added successfully.';
         header("location: ../../views/pages/class_page.php?id=$classId");
         die();
      } 
   } else {
      $_SESSION['error'] = 'This student is not exists !!';
      header("location: ../../views/pages/class_page.php?id=$classId");
      die();
   }
}

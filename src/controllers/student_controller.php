<?php
session_start();
include __DIR__. '/../repositories/student_repository.php';

// delete student in a class
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'GET') {
   $classId= $_GET['classId'];
   $studentId=$_GET['studentId'];

   
   delete_student_in_class($classId, $studentId);

   header("location: ../../views/pages/class_page.php?id=$classId");
   die();
}

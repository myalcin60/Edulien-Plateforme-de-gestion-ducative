<?php
session_start();
include __DIR__ . '/../repositories/student_repository.php';

// delete student in a class
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "lesson_page") and $_SERVER['REQUEST_METHOD'] == 'GET') {
   $lessonId = $_GET['lessonId'];
   $studentId = $_GET['studentId'];


   delete_student_in_lesson_students($lessonId, $studentId);

   header("location: ../../views/pages/lesson_page.php?id=$lessonId");
   die();
}
// add student

if (
   isset($_SERVER["HTTP_REFERER"]) &&
   str_contains($_SERVER['HTTP_REFERER'], 'lesson_page.php') &&
   $_SERVER['REQUEST_METHOD'] === 'POST'
) {
   $lessonId = $_POST['lessonId'] ?? null;
   $classId = $_POST['classId'] ?? null;
   $email = $_POST['email'] ?? null;


   if ($email == '') {
      $_SESSION['error'] = 'Please enter an email address';
      header("location: ../../views/pages/lesson_page.php?id=$lessonId");
      die();
   } else {
      $student = get_student__from_users($email);
      if ($student['id'] == null) {
         $_SESSION['error'] = 'This student is not exists !';
         header("location: ../../views/pages/lesson_page.php?id=$lessonId");
         die();
      } else {
         $result = get_student__from_lesson_students($email, $lessonId);
      }
   }
  

}
      $cl_Id= get_students_classId_by_email($email);
      
      if ($student['id'][0] != 'T') {
         if ($lessonId == $result['lessonId']) {
            $_SESSION['error'] = 'This student already exists !';
            header("location: ../../views/pages/lesson_page.php?id=$lessonId");
            die();
         } else {
            add_student($lessonId, $student['id'], $student['first_name'], $student['email'], $classId);
            $_SESSION['success'] = 'Student added successfully.';
            header("location: ../../views/pages/lesson_page.php?id=$lessonId");
            die();
         }
      } else {
         $_SESSION['error'] = 'This student is not exists !';
         header("location: ../../views/pages/lesson_page.php?id=$lessonId");
         die();
      }

   



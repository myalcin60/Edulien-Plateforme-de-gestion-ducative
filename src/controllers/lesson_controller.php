<?php
include __DIR__ . '/../repositories/lesson_repository.php';
include_once __DIR__ . '/../../src/services/lesson_services.php';
// creat lesson

if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   $lessonName = $_POST['lesson'];
   $classId = $_POST['classId'];
   $teacherId = $_POST['teacherId'];

   if ($_POST['formType'] === 'create_lesson') {
      echo $lessonName, $teacherId, $classId;
      creat_lesson($lessonName, $teacherId, $classId);
      header("location: ../../views/pages/class_page.php?classId=$classId");
      die();
   } else {
      session_unset();
      session_destroy();
      header("location: ../../views/pages/main.php?form=login");
      die();
   }
}

// delete lesson
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'GET') {
   echo $_GET['id'];
   $classId = $_REQUEST['classId'];
   echo $classId;
   delete_lesson($_GET['id']);
   header("location: ../../views/pages/class_page.php?classId=$classId");
   die();
}

// update lesson name
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "update_lesson_name.php") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   $classId = $_REQUEST['classId'];
   update_lesson($_POST['lessonId'], $_POST['lesson'] );
   header("location: ../../views/pages/class_page.php?classId=$classId");
   die();

}

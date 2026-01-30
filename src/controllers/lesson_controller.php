<?php
session_start();
include __DIR__ . '/../repositories/lesson_repository.php';
include_once __DIR__ . '/../../src/services/lesson_services.php';
include __DIR__ . '/../services/service.php';

// creat lesson
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   $lessonName = ucfirst(strtolower(trim($_POST['lesson'])));
   $classId = $_POST['classId'];
   $teacherId =trim( $_POST['teacherId']);
   $lessonId = uuid();

   $lessons= get_lessons_with_classId($classId);
   $list = [];
   foreach ($lessons as $lesson) {
      $list[] = $lesson['lessonName'];
   }

   if (in_array(strtolower($lessonName), array_map('strtolower', $list))) {

      $_SESSION['error'] = 'This lesson already exists !!!';
      header("location: ../../views/pages/class_page.php?classId=$classId");
      die();
   } else {
      creat_lesson($lessonId, $lessonName, $teacherId, $classId);
      $_SESSION['success'] = 'Lesson created successfully.';
      header("location: ../../views/pages/class_page.php?classId=$classId");
      die();
   }
}

// delete lesson
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'GET') {
   echo $_GET['id'];
   $classId = $_REQUEST['classId'];
   echo $classId;
   delete_lesson($_GET['id']);
   $_SESSION['success'] = 'Lesson deleted successfully.';
   header("location: ../../views/pages/class_page.php?classId=$classId");
   die();
}

// update lesson name
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "update_lesson_name.php") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   $classId = $_REQUEST['classId'];
   $lessonName = ucfirst(strtolower(trim($_POST['lesson'])));
   $lessonId = trim($_POST['lessonId']);

   update_lesson($lessonId, $lessonName);
   $_SESSION['success'] = 'Lesson updated successfully.';
   header("location: ../../views/pages/class_page.php?classId=$classId");
   die();

}

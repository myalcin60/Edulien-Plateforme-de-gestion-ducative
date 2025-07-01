<?php
session_start();
include __DIR__ . '/../repositories/class_repository.php';
include __DIR__ . '/../services/service.php';

if (str_contains($_SERVER['HTTP_REFERER'], "form=classes") and $_SERVER['REQUEST_METHOD'] == 'POST') {
   $className = $_POST['class_name'];
   create_class($_SESSION['id'], $className);
   header("location: ../../views/pages/teacher_dashboard.php?form=classes");
   die();
}

if (str_contains($_SERVER['HTTP_REFERER'], "class_page") and $_SERVER['REQUEST_METHOD'] == 'GET') {
   $className = $_POST['class_name'];
   create_class($_SESSION['id'], $className);
   header("location: ../../views/pages/teacher_dashboard.php?form=classes");
   die();
}

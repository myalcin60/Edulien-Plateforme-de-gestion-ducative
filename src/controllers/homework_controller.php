<?php
session_start();
include_once __DIR__ . '/../repositories/homework_repository.php';

// creat homwork 
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "teacher_dashboard.php") and $_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacherId = $_POST['userId'];
    $title = $_POST['hm_title'];
    $homework = $_POST['homework'];
    $classId = $_POST['classId'];
    $lessonId = $_POST['lessonId'];
    $studentIds = $_POST['studentIds'] ?? [];
    var_dump($studentIds);
    $filePath = null;
    $fileType = null;

    // control upload fichier
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $uploadDir = __DIR__ . "/../uploads/homeworks/";
        // $uploadDir = __DIR__ . "../../../uploads/homeworks/"; //--pour infinity
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $cleanName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", basename($_FILES['file']['name']));
        $fileName = time() . "_" . $cleanName;
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            $filePath = "uploads/homeworks/" . $fileName;

            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $fileType = 'image';
            } elseif ($ext === 'pdf') {
                $fileType = 'pdf';
            } else {
                $fileType = 'text';
            }
        }
    }

    create_homework($teacherId, $studentIds, $classId, $lessonId, $title, $homework, $filePath, $fileType);
    $_SESSION['success'] = 'Homework created successfully!';
    header("location: ../../views/pages/teacher_dashboard.php?form=homework&classId=$classId&lessonId=$lessonId");
    die();
}
// delete homework
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "action=homeworks") and $_SERVER['REQUEST_METHOD'] == 'GET') {


    if (!empty($_GET['homeworkIds'])) {
        delete_homework($_GET['homeworkIds']);
    }
    $_SESSION['success'] = 'Homework deleted successfully!';
    header("location: ../../views/pages/teacher_dashboard.php?form=homework&action=homeworks");
    die();
}


// answer homework
if (isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], "answer_hm.php") and $_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = $_SESSION['id'];
    $homeworkId = $_POST['homeworkId'];
    $answerText = $_POST['homework'];
    $filePath = null;
    $fileType = null;

    // control upload fichier
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $uploadDir = __DIR__ . "/../uploads/answers/";
        // $uploadDir = __DIR__ . "../../../uploads/answers/"; //--pour infinity
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $cleanName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", basename($_FILES['file']['name']));
        $fileName = time() . "_" . $cleanName;
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            $filePath = "uploads/answers/" . $fileName;

            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $fileType = 'image';
            } elseif ($ext === 'pdf') {
                $fileType = 'pdf';
            } else {
                $fileType = 'text';
            }
        }
    }

    answer_homework($homeworkId, $studentId, $answerText, $filePath,  $fileType);
    $_SESSION['success'] = 'Homework answered successfully!';
    header("location: ../../views/pages/answer_hm.php?id=$homeworkId");
    die();
}
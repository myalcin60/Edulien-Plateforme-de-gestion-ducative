<?php
require_once __DIR__ . '/../config/connection.php';

// function get_students_in_class($classId)
// {
//     try {
//         $pdo = db_connection();
//         $sql = "SELECT * FROM students AS st
//                 JOIN classes AS cl ON st.classId = cl.classId
//                 WHERE cl.classId = :classId";

//         $query = $pdo->prepare($sql);
//         $query->bindParam(":classId", $classId);
//         $query->execute();

//         return $query->fetchAll(PDO::FETCH_ASSOC);

//     } catch (PDOException $ex) {
//         echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
//     }
// }
function get_students_in_lesson($lessonId)
{
    try {
        $pdo = db_connection();
        $sql = "SELECT * FROM lesson_students AS ls
                JOIN lessons AS l ON ls.lessonId = l.lessonId
                WHERE l.lessonId = :lessonId";

        $query = $pdo->prepare($sql);
        $query->bindParam(":lessonId", $lessonId);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

//student class
function delete_student_in_class($classId, $studentId)
{
    try {
        $pdo = db_connection();
        $sql = "Delete from students
        where classId= :classId and studentId= :studentId";
        $query = $pdo->prepare($sql);
        $query->bindValue("classId", $classId);
        $query->bindValue("studentId", $studentId);
        $query->execute();
    } catch (Exception $ex) {
        echo "Class deletion failed" . $ex->getMessage();
    }
}

function get_student__from_users($email)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * from users
        where email = :email';
        $query = $pdo->prepare($sql);
        $query->bindValue('email', $email);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}


// function get_student__from_students($email, $classId)
// {
//     try {
//         $pdo = db_connection();
//         $sql = 'SELECT * from students
//         where studentEmail = :email and classId= :classId';
//         $query = $pdo->prepare($sql);
//         $query->bindValue('email', $email);
//          $query->bindValue('classId', $classId);
//         $query->execute();

//         return $query->fetch(PDO::FETCH_ASSOC);
//     } catch (Exception $ex) {
//         echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
//     }
// }

function get_student__from_lesson_students($email, $lessonId)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * from lesson_students
        where studentEmail = :email and lessonId= :lessonId';
        $query = $pdo->prepare($sql);
        $query->bindValue('email', $email);
        $query->bindValue('lessonId', $lessonId);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

//add student in class
// function add_student($classId, $studentId, $studentName, $studentEmail)
// {
//     if(empty($studentId) || $studentId[0]=='T'){
//         echo 'invalid email';
//     }else{

//         try {
//             $pdo = db_connection();
//             $sql = 'INSERT INTO students ( classId, studentId, studentName, studentEmail ) values ( :classId, :studentId, :studentName, :studentEmail)';
//             $query = $pdo->prepare($sql);
//             $query->bindValue("classId", $classId);
//             $query->bindValue("studentId", $studentId);
//             $query->bindValue("studentName", $studentName);
//             $query->bindValue("studentEmail", $studentEmail);
//             $query->execute();
//         } catch (Exception $ex) {
//             echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
//         }
//     }


// }

//add student in lesson
function add_student($lessonId, $studentId,  $studentEmail, $studentName, $classId)
{
    if (empty($studentId) || $studentId[0] == 'T') {
        echo 'invalid email';
    } else {

        try {
            $pdo = db_connection();
            $sql = 'INSERT INTO lesson_students ( lessonId, studentId, studentEmail, studentName,  classId ) values (:lessonId , :studentId, :studentName, :studentEmail, :classId)';
            $query = $pdo->prepare($sql);
            $query->bindValue("lessonId", $lessonId);
            $query->bindValue("studentId", $studentId);
            $query->bindValue("studentEmail", $studentEmail);
            $query->bindValue("studentName", $studentName);
            $query->bindValue("classId", $classId);
            $query->execute();
        } catch (Exception $ex) {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
        }
    }


}
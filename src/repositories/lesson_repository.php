<?php 
require_once __DIR__ . '/../config/connection.php';
//craet lesson
function creat_lesson($lessonName, $teacherId, $classId)
{
    try {
        $pdo = db_connection();
        $sql = 'INSERT INTO lessons ( lessonName, teacherId, classId ) values ( :lessonName, :teacherId, :classId)';
        $query = $pdo->prepare($sql);
        $query->bindValue("lessonName", $lessonName);
        $query->bindValue("teacherId", $teacherId);
        $query->bindValue("classId", $classId);
        $query->execute();
    } catch (Exception $ex) {
        echo 'Error: problème de create lesson';
    }

}
// get lessons with lesson id
function get_lesson_by_lessonId($lessonId)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * from lessons
    where lessonId = :lessonId';
        $query = $pdo->prepare($sql);
        $query->bindValue('lessonId', $lessonId);
        $query->execute();
        return $query->fetchAll();
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}
//get lesson with classId
function get_lessons_with_classId($classId)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * FROM lessons WHERE classId= :classId';
        $query = $pdo->prepare($sql);
        $query->bindValue("classId", $classId);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}
//get lessons for student
function get_student_lessons($studentId)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT l.lessonId, lessonName, us.first_name, us.last_name  FROM lessons as l
        JOIN lesson_students as st on  l.lessonId=st.lessonId
        Join users as us on  l.teacherId=us.id
        where st.studentId = :studentId';

        $query = $pdo->prepare($sql);
        $query->bindValue("studentId", $studentId);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

// delete lesson
function delete_lesson($lessonId)
{
    try {
        $pdo = db_connection();
        $sql = "Delete from lessons
        where lessonId= :lessonId";
        $query = $pdo->prepare($sql);
        $query->bindValue("lessonId", $lessonId);
        $query->execute();
    } catch (Exception $ex) {
        echo "Lesson deletion failed" . $ex->getMessage();
    }
}

function update_lesson($lessonId, $lessonName)
{
    try {
        $pdo = db_connection();
        $sql = " Update lessons
                 SET lessonName = :lessonName
                 WHERE lessonId = :lessonId ";
        $query = $pdo->prepare($sql);
        $query->bindValue("lessonId", $lessonId);
        $query->bindValue("lessonName", $lessonName);
        $query->execute();
    } catch (Exception $ex) {
        echo "Class deletion failed" . $ex->getMessage();
    }
}

<?php
include __DIR__ . '/../config/connection.php';

// creaat class for teacher
function create_class($userId, $className)
{
    try {
        $pdo = db_connection();
        $sql = 'INSERT INTO classes ( className, teacherId ) values ( :className, :teacherId)';
        $query = $pdo->prepare($sql);
        $query->bindValue("className", $className);
        $query->bindValue("teacherId", $userId);
        $query->execute();
    } catch (Exception $ex) {
        echo 'Error: problème de create class';
    }
}
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

//get class with teacher id
function get_classes($teacherId)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * from classes
    where teacherId = :teacherId';
        $query = $pdo->prepare($sql);
        $query->bindValue('teacherId', $teacherId);

        $query->execute();
        return $query->fetchAll();
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

//get class with class id 
function get_class_by_classId($classId)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * from classes
    where classId = :classId';
        $query = $pdo->prepare($sql);
        $query->bindValue('classId', $classId);
        $query->execute();
        return $query->fetchAll();
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

// get lessons with lesson id
function get_lessons_by_lessonId($lessonId)
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

//get classes for student
function get_classes_for_student($studentId)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT cl.classId, className, us.first_name, us.last_name  FROM classes as cl
        JOIN students as st on  cl.classId=st.classId
        Join users as us on  cl.teacherId=us.id
        where st.studentId = :studentId';

        $query = $pdo->prepare($sql);
        $query->bindValue("studentId", $studentId);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

//get lessons for student
function get_lessons_for_student($studentId)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT l.lessonId, lessonName, us.first_name, us.last_name  FROM lessons as l
        JOIN lesoon_students as st on  l.lessonId=st.lessonId
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

//delete class
function delete_class($classId)
{
    try {
        $pdo = db_connection();
        $sql = "Delete from classes
        where classId= :classId";
        $query = $pdo->prepare($sql);
        $query->bindValue("classId", $classId);
        $query->execute();
    } catch (Exception $ex) {
        echo "Class deletion failed" . $ex->getMessage();
    }
}

// update class namespace
function update_calss($classId, $className)
{
    try {
        $pdo = db_connection();
        $sql = " Update classes
                 SET className = :className
                 WHERE classId = :classId ";
        $query = $pdo->prepare($sql);
        $query->bindValue("classId", $classId);
        $query->bindValue("className", $className);
        $query->execute();
    } catch (Exception $ex) {
        echo "Class deletion failed" . $ex->getMessage();
    }
}

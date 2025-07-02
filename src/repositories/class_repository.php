<?php
include __DIR__ . '/../config/connection.php';

function create_class($user_id,  $className)
{
    try {
        $pdo = db_connection();
        $sql = 'INSERT INTO classes ( className, teacherId ) values ( :className, :teacherId)';
        $query = $pdo->prepare($sql);
        $query->bindValue("className", $className);
        $query->bindValue("teacherId", $user_id);
        $query->execute();
    } catch (Exception $ex) {
        echo 'Error: problème de create class';
    }
}

function get_classes($teacher_id)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * from classes
    where teacherId = :teacherId';
        $query = $pdo->prepare($sql);
        $query->bindValue('teacherId', $teacher_id);

        $query->execute();
        return $query->fetchAll();
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}


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


function get_student__from_users($email)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * from users
        where email = :email';
        $query = $pdo->prepare($sql);
        $query->bindValue('email', $email);
        $query->execute();

        return $query->fetch();
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

function get_student__from_students($email)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * from students
        where studentEmail = :email';
        $query = $pdo->prepare($sql);
        $query->bindValue('email', $email);
        $query->execute();

        return $query->fetch();
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

function add_student($classId, $studentId, $studentName, $studentEmail)
{
    

        try {
            $pdo = db_connection();
            $sql = 'INSERT INTO students ( classId, studentId, studentName, studentEmail ) values ( :classId, :studentId, :studentName, :studentEmail)';
            $query = $pdo->prepare($sql);
            $query->bindValue("classId", $classId);
            $query->bindValue("studentId", $studentId);
            $query->bindValue("studentName", $studentName);
            $query->bindValue("studentEmail", $studentEmail);
            $query->execute();
        } catch (Exception $ex) {
            echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
        }
    
}

function get_classes_for_student($studentId)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT cl.classId, className FROM classes as cl
        JOIN students as st on  cl.classId=st.classId
        where st.studentId = :studentId';

        $query = $pdo->prepare($sql);
        $query->bindValue("studentId", $studentId);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

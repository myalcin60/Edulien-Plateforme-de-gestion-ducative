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

function get_classes($user_id)
{
    try {
        $pdo = db_connection();
        $sql = 'SELECT * from classes
    where teacherId = :teacherId';
        $query = $pdo->prepare($sql);
        $query->bindValue('teacherId', $user_id);

        $query->execute();
        return $query->fetchAll();
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

function get_student($email)
{

    try {
        $pdo = db_connection();
        $sql = 'SELECT * from classes
        where emeil = :emeil';
        $query = $pdo->prepare($sql);
        $query->bindValue('emeil', $email);
        return $query->fetch();

    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

function add_student($classId, $studentId, $studentName, $studentEmail){
    try{
       $pdo = db_connection() ;
       $sql = 'INSERT INTO students ( classId, studentId, studentName, studentEmail ) values ( :classId, :studentId, :studentName, :studentEmail)';
        $query = $pdo->prepare($sql);
        $query->bindValue("classId", $classId);
        $query->bindValue("studentId", $studentId);
        $query->bindValue("studentName", $studentName);
        $query->bindValue("studentEmail", $studentEmail);
        $query->execute();

    }
       catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

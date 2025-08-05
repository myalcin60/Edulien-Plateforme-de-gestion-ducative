<?php
include __DIR__ . '/../config/connection.php';

// creaat class for teacher
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

//get class with teacher id
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
function update_calss($classId, $nom)
{
    try {
        $pdo = db_connection();
        $sql = " Update classes
                 SET nom = :nom
                 WHERE classId = :classId ";
        $query = $pdo->prepare($sql);
        $query->bindValue("classId", $classId);
        $query->bindValue("nom", $nom);
        $query->execute();
    } catch (Exception $ex) {
        echo "Class deletion failed" . $ex->getMessage();
    }
}

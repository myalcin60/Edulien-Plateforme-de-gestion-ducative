<?php
require_once __DIR__ . '/../config/connection.php';

function get_students_in_class($classId)
{
    try {
        $pdo = db_connection();
        $sql = "SELECT * FROM students AS st
                JOIN classes AS cl ON st.classId = cl.classId
                WHERE cl.classId = :classId";

        $query = $pdo->prepare($sql);
        $query->bindParam(":classId", $classId);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}


//student class
function delete_student_in_class($classId, $studentId){
    try{
        $pdo = db_connection();
        $sql = "Delete from students
        where classId= :classId and studentId= :studentId";
        $query = $pdo->prepare($sql);
        $query->bindValue("classId", $classId);
         $query->bindValue("studentId", $studentId);
        $query->execute();
         }catch (Exception $ex) {
            echo "Class deletion failed". $ex->getMessage();
         }
}
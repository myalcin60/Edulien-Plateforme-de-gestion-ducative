<?php
include __DIR__ . '/../config/connection.php';

function signup_user($id, $firstname, $lastname, $email, $password, $role)
{
    try {
        $pdo = db_connection();     

        $sql = "INSERT INTO users (id, first_name, last_name, email, password, role)
                VALUES (:id, :first_name, :last_name, :email, :password, :role)";

        $query = $pdo->prepare($sql);

        $query->bindValue(":id", $id);
        $query->bindValue(":first_name", $firstname);
        $query->bindValue(":last_name", $lastname);
        $query->bindValue(":email", $email);
        $query->bindValue(":password", $password);
        $query->bindValue(":role", $role);

        $query->execute();
       
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}


function get_user($email,$password){
    try{
    $pdo = db_connection();
    $sql = "SELECT * from users  WHERE email= :email and password= :password";
    $query = $pdo->prepare($sql);
    $query->bindValue(":email", $email);
     $query->bindValue(":password", $password);
    $query->execute();

    return $query->fetch();
}catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

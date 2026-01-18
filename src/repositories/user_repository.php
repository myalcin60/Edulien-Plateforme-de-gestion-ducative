<?php
include __DIR__ . '/../config/connection.php';
include __DIR__. '/../models/userModel.php';
include __DIR__ . '/../models/classModels.php';
include_once __DIR__ . '/../models/lessonModels.php';
include_once __DIR__ . '/../models/lessonStudentModel.php';
include __DIR__. '/../models/homeworkModel.php';
include __DIR__. '/../models/answerHmModels.php';

//sign up
function signup_user($id, $firstname, $lastname, $email, $password, $role)
{
    try {
        $pdo = db_connection();
        createUserTable();
        createClassTable();
        createLessonTable();
        createLessonsStudentTable();
        createHomeworkTable();  
        createHomeworkAnswerTable();      

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
// login
function get_user_by_id($id)
{
    try {
        $pdo = db_connection();
        $sql = "SELECT * from users  WHERE id= :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(":id", $id);

        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

// get user with by email
function get_user_by_email($email)
{
    try {
        $pdo = db_connection();
        $sql = "SELECT * from users  WHERE email= :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(":email", $email);

        $query->execute();
        return $query->fetch();
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}
// upload  user photo
function uplad_user_photo($userId, $fileContent, $fileType)
{
    try {
        $pdo = db_connection();
        $sql = "UPDATE users 
                   SET profile_photo = :photo, 
                       profile_photo_type = :fileType 
                 WHERE id = :userId";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':photo' => $fileContent,
            ':fileType' => $fileType,
            ':userId' => $userId
        ]);
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}
// get user photo
function get_user_photo($userId)
{
    try {
        $pdo = db_connection();
        $sql = "Select profile_photo from users  WHERE id= :userId";
        $query = $pdo->prepare($sql);
        $query->bindValue(':userId', $userId);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['profile_photo']) {
            // BLOB verisini base64'e dönüştür
            $imageData = base64_encode($result['profile_photo']);
            return 'data:image/jpeg;base64,' . $imageData;
        }

        return null;
    } catch (Exception $ex) {
        echo "Erreur : problème de connexion avec la BD: " . $ex->getMessage();
        return null;
    }
}
// update user profile
function update_user_profile($id, $email, $first_name, $last_name, $gender, $specialization)
{
    try {
        $pdo = db_connection();
        $sql = "UPDATE users SET email = ?, first_name = ?, last_name = ?, gender = ?, specialization = ? WHERE id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$email, $first_name, $last_name, $gender, $specialization, $id]);

    } catch (\Throwable $ex) {
        echo "Erreur : problème de connexion avec la BD: " . $ex->getMessage();
        return null;
    }
}

// delete user
function delete_user($userId)
{
    try {
        $pdo = db_connection();
        $sql = "DELETE FROM users WHERE id = :userId";
        $query = $pdo->prepare($sql);
        $query->bindValue(':userId', $userId);
        $query->execute();
    } catch (Exception $ex) {
        echo "\nErreur : problème de connexion avec la BD: " . $ex->getMessage();
    }
}

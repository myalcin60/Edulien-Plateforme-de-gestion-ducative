<?PHP
include_once __DIR__ . '/../config/connection.php';
include __DIR__ . '/../models/homeworkModel.php';
// create homework
function create_homework($id, $teacherId, $studentIds, $classId, $lessonId, $title, $description, $filePath, $fileType)
{
    try {
        $pdo = db_connection();
        createHomeworkTable();
        $homeworkId = 'HW-' . time() . '-' . rand(1000, 9999);

        $sql = 'INSERT INTO homeworks 
            (id, homeworkId, teacherId, studentId, classId, lessonId, title, description, filePath, fileType) 
            VALUES  (:id, :homeworkId, :teacherId, :studentId, :classId, :lessonId, :title, :description, :filePath, :fileType) ';
        $query = $pdo->prepare($sql);

        foreach ($studentIds as $studentId) {
            $query->bindValue("id", $id);
            $query->bindValue("homeworkId", $homeworkId);
            $query->bindValue("teacherId", $teacherId);
            $query->bindValue("studentId", $studentId);
            $query->bindValue("classId", $classId);
            $query->bindValue("lessonId", $lessonId);
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
            $query->bindValue("filePath", $filePath);
            $query->bindValue("fileType", $fileType);
            $query->execute();
        }
        return true;
    } catch (PDOException $th) {
        error_log("Homework Insert Error: " . $th->getMessage());
        return false;
    }
}

// get lesson with user Id
function get_homeworks_by_userId($userId)
{
    try {
        $pdo = db_connection();

        if ($userId[0] == 'T') {
            $sql = 'Select * from homeworks
        where teacherId= :teacherId 
        GROUP BY title, lessonId';
            $query = $pdo->prepare($sql);
            $query->bindValue("teacherId", $userId);
        } else {
            $sql = 'Select * from homeworks
                     where studentId= :studentId';
            $query = $pdo->prepare($sql);
            $query->bindValue("studentId", $userId);
        }

        $query->execute();
        return $query->fetchAll();
    } catch (\Throwable $th) {
        error_log("Homeworks Get Error: " . $th->getMessage());
        return false;
    }
}
// get homework with homework id
function get_homework($Id)
{
    try {
        $pdo = db_connection();

        $sql = 'Select * from homeworks
        where id= :id 
        GROUP BY title, lessonId';
        $query = $pdo->prepare($sql);
        $query->bindValue("id", $Id);


        $query->execute();
        return $query->fetch();
    } catch (\Throwable $th) {
        error_log("Homeworks Get Error: " . $th->getMessage());
        return false;
    }
}

// delete homework
function delete_homework($homeworkIds)
{
    try {
        $pdo = db_connection();

        foreach ($homeworkIds as $hwId) {
            // önce ilgili ödevin title/class/lesson ve filePath bilgilerini al
            $sql = 'SELECT title, classId, lessonId, filePath FROM homeworks WHERE id = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$hwId]);
            $hw = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($hw) {
                // sunucudaki dosyayı sil
                if (!empty($hw['filePath']) && file_exists(__DIR__ . '/../' . $hw['filePath'])) {
                    unlink(__DIR__ . '/../' . $hw['filePath']);
                }
                // aynı title, class ve lesson için tüm öğrencilerin ödevlerini sil
                $delSql = 'DELETE FROM homeworks WHERE title = ? AND classId = ? AND lessonId = ?';
                $delStmt = $pdo->prepare($delSql);
                $delStmt->execute([$hw['title'], $hw['classId'], $hw['lessonId']]);
            }
        }
        return true;
    } catch (\Throwable $th) {
        error_log("Homework could not be deleted: " . $th->getMessage());
        return false;
    }
}

// add answer homework
function answer_homework($id, $homeworkId, $studentId,  $description, $filePath, $fileType)
{
    try {
        $pdo = db_connection();
        // createHomeworkAnswerTable();

        $sql = 'INSERT INTO hm_answer 
            (id, homeworkId, studentId, description, filePath, fileType) 
            VALUES  (:id, :homeworkId, :studentId, :description, :filePath, :fileType) ';
        $query = $pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->bindValue("homeworkId", $homeworkId);
        $query->bindValue("studentId", $studentId);
        $query->bindValue("description", $description);
        $query->bindValue("filePath", $filePath);
        $query->bindValue("fileType", $fileType);
        $query->execute();
        return true;
    } catch (PDOException $th) {
        error_log("Homework Answer Insert Error: " . $th->getMessage());
        return false;
    }
}
// get answers by homeworkId and studentId
function get_homework_answers($homeworkId, $studentId)
{
    try {
        $pdo = db_connection();

        $sql = 'Select * from hm_answer
        where homeworkId= :homeworkId AND studentId= :studentId';
        $query = $pdo->prepare($sql);
        $query->bindValue("homeworkId", $homeworkId);
        $query->bindValue("studentId", $studentId);

        $query->execute();
        return $query->fetchAll();
    } catch (\Throwable $th) {
        error_log("Homework Answers Get Error: " . $th->getMessage());
        return false;
    }
}

// get answers by homeworkId and teacherId
function get_answers($homeworkId, $teacherId)
{
    try {
        $pdo = db_connection();

        $sql = 'Select a.*, u.first_name, u.last_name
                FROM hm_answer as a
                INNER JOIN homeworks as h ON a.homeworkId = h.id
                INNER JOIN users as u ON a.studentId = u.id
                WHERE h.homeworkId = :homeworkId      
                AND h.teacherId = :teacherId';

        $query = $pdo->prepare($sql);
        $query->bindValue("homeworkId", $homeworkId);
        $query->bindValue("teacherId",$teacherId);
        $query->execute();
        return $query->fetchAll();
        } catch (\Throwable $th) {
        error_log("Homework Answers Get Error: " . $th->getMessage());
        return false;
    }
}

// get homeworkId by id
function get_homeworkId_by_id($id){
    try {
        $pdo = db_connection();

        $sql = 'Select homeworkId from homeworks
        where id= :id ';
        $query = $pdo->prepare($sql);
        $query->bindValue("id", $id);   
        $query->execute();
        return $query->fetchColumn();   
        }
    catch (\Throwable $th) {
        error_log("Homework Get Error: " . $th->getMessage());
        return false;
    }
}
// delete answer homework
function delete_answer_homework($answerId){
    try {
        $pdo = db_connection();

        // take filepath of answer
        $sql = 'SELECT filePath FROM hm_answer WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$answerId]);
        $answer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($answer) {
            // delete file from server
            if (!empty($answer['filePath']) && file_exists(__DIR__ . '/../' . $answer['filePath'])) {
                unlink(__DIR__ . '/../' . $answer['filePath']);
            }
            // delete answer from database
            $delSql = 'DELETE FROM hm_answer WHERE id = ?';
            $delStmt = $pdo->prepare($delSql);
            $delStmt->execute([$answerId]);
        }
        return true;
    } catch (\Throwable $th) {
        error_log("Answer could not be deleted: " . $th->getMessage());
        return false;
    }
}
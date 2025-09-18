<?PHP
include_once __DIR__ . '/../config/connection.php';

// create homework
function create_homework($teacherId, $studentIds, $classId, $lessonId, $title, $description, $filePath, $fileType)
{
    try {
        $pdo = db_connection();

        $sql = 'INSERT INTO homeworks 
            (teacherId, studentId, classId, lessonId, title, description, filePath, fileType) 
            VALUES  (:teacherId, :studentId, :classId, :lessonId, :title, :description, :filePath, :fileType) ';
        $query = $pdo->prepare($sql);

        foreach ($studentIds as $studentId) {
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


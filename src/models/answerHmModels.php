<?php
function createHomeworkAnswerTable()
{
    try {
        $pdo = db_connection();
        $sql = "
        
    CREATE TABLE IF NOT EXISTS hm_answer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    homeworkId INT NOT NULL,
    studentId VARCHAR(20) NOT NULL,
    description TEXT NULL,
    filePath VARCHAR(255) NULL,
    fileType VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (homeworkId) REFERENCES homeworks (id) ON DELETE CASCADE,
    FOREIGN KEY (studentId) REFERENCES users (id) ON DELETE CASCADE
)";
        $pdo->exec($sql);
    } catch (Throwable $e) {
        echo "Connection or table creation error: " . $e->getMessage();
    }
}

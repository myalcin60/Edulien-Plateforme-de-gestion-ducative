<?php
function createHomeworkAnswerTable()
{
    try {
        $pdo = db_connection();
        $sql = "
        
    CREATE TABLE IF NOT EXISTS hm_answer (
    id CHAR(36) NOT NULL UNIQUE PRIMARY KEY,
    homeworkId CHAR(36) NOT NULL,
    studentId VARCHAR(250) NOT NULL,
    description TEXT NULL,
    filePath VARCHAR(255) NULL,
    fileType VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (homeworkId) REFERENCES homeworks (id) ON DELETE CASCADE,
    FOREIGN KEY (studentId) REFERENCES users (id) ON DELETE CASCADE
)ENGINE=InnoDB";
        $pdo->exec($sql);
    } catch (Throwable $e) {
        echo "Connection or table creation error: " . $e->getMessage();
    }
}

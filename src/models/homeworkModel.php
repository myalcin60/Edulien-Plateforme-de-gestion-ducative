<?php
function createHomeworkTable()
{
    try {
        $pdo = db_connection();
        $sql = "
        
    CREATE TABLE IF NOT EXISTS homeworks (
    id CHAR(36) NOT NULL UNIQUE PRIMARY KEY,
    homeworkId VARCHAR(30) NOT NULL,
    teacherId VARCHAR(20) NOT NULL,
    studentId VARCHAR(20) NOT NULL,
    classId CHAR(36) NOT NULL,
    lessonId CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    filePath VARCHAR(255) NULL,
    fileType VARCHAR(20) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacherId) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (studentId) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (classId) REFERENCES classes (classId) ON DELETE CASCADE,
    FOREIGN KEY (lessonId) REFERENCES lessons (lessonId) ON DELETE CASCADE
)";
        $pdo->exec($sql);
    } catch (Throwable $e) {
        echo "Connection or table creation error: " . $e->getMessage();
    }
}

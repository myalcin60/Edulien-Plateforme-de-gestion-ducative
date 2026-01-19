<?php
function createLessonsStudentTable()
{
    try {
        $pdo = db_connection();
        $sql = "
    CREATE TABLE IF NOT EXISTS lesson_students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lessonId CHAR(36) NOT NULL,
    studentId VARCHAR(20) NOT NULL,
    studentName VARCHAR(100),
    studentEmail VARCHAR(100),
    classId CHAR(36) not NULL,
    addedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lessonId) REFERENCES lessons (lessonId) ON DELETE CASCADE,
    FOREIGN KEY (studentId) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (classId) REFERENCES classes (classId) ON DELETE CASCADE
)";
        $pdo->exec($sql);
    } catch (Throwable $e) {
        echo "Connection or table creation error: " . $e->getMessage();
    }
}

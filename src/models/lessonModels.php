<?php
function createLessonTable()
{
    try {
        $pdo = db_connection();
        $sql = "
        
    CREATE TABLE  IF NOT EXISTS lessons (
    lessonId CHAR(36) NOT NULL UNIQUE PRIMARY KEY,
    lessonName VARCHAR(100),
    teacherId VARCHAR(250) NOT NULL,
    classId CHAR(36) not NULL,
    addedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacherId) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (classId) REFERENCES classes (classId) ON DELETE CASCADE
)";
        $pdo->exec($sql);
    } catch (Throwable $e) {
        echo "Connection or table creation error: " . $e->getMessage();
    }
}

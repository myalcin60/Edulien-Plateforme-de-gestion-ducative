<?php
function createClassTable()
{
    try {
        $pdo = db_connection();
        $sql = "
        
    CREATE Table IF NOT EXISTS classes (
    classId CHAR(36) NOT NULL UNIQUE PRIMARY KEY,
    className VARCHAR(100) NOT NULL,
    teacherId VARCHAR(250) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacherId) REFERENCES users (id) ON DELETE CASCADE
)ENGINE=InnoDB";
        $pdo->exec($sql);
    } catch (Throwable $e) {
        echo "Connection or table creation error: " . $e->getMessage();
    }
}

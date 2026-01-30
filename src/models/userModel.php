<?php
function createUserTable()
{
    try {
        $pdo = db_connection();
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id VARCHAR(250) PRIMARY KEY NOT NULL,
                first_name VARCHAR(250) NOT NULL,
                last_name VARCHAR(250) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                role VARCHAR(255) NOT NULL,
                createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )ENGINE=InnoDB
        ";
        $pdo->exec($sql);
        echo " 'users' table created or already exists.<br>";

        $alterations = [
            "ALTER TABLE users ADD COLUMN profile_photo VARCHAR(255)",
            "ALTER TABLE users ADD COLUMN specialization VARCHAR(250)",
            "ALTER TABLE users ADD COLUMN gender VARCHAR(25)",
            "ALTER TABLE users MODIFY COLUMN profile_photo LONGBLOB",
            "ALTER TABLE users ADD COLUMN profile_photo_type VARCHAR(50)"
           
        ];

        foreach ($alterations as $alter) {
            try {
                $pdo->exec($alter);
                echo  htmlspecialchars($alter) . " executed successfully.<br>";
            } catch (PDOException $e) {
                if (str_contains($e->getMessage(), 'Duplicate column name')) {
                    echo "Column already exists, skipped.<br>";
                } else {
                    echo "Error executing alteration: " . $e->getMessage() . "<br>";
                }
            }
        }

        echo "<br> Table structure verified successfully.";
    } catch (Throwable $e) {
        echo "Connection or table creation error: " . $e->getMessage();
    }
}
if (basename(__FILE__) === basename($_SERVER["SCRIPT_FILENAME"])) {
    createUserTable();
}

CREATE DATABASE edu;

use edu;

CREATE Table users (
    id VARCHAR(250) PRIMARY KEY NOT NULL,
    first_name VARCHAR(250) NOT NULL,
    last_name VARCHAR(250) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SELECT * FROM users;

INSERT INTO
    users (
        id,
        first_name,
        last_name,
        email,
        password,
        role
    )
VALUES (
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'role'
    );

DELETE from users WHERE id = 'S_55147';

CREATE Table classes (
    classId INT AUTO_INCREMENT PRIMARY KEY,
    className VARCHAR(100) NOT NULL,
    teacherId VARCHAR(20) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacherId) REFERENCES users (id) ON DELETE CASCADE
);

SELECT * FROM classes;

DELETE FROM classes where classId in ( 4,5,6,7,8,9,10);


CREATE TABLE students (
 id INT AUTO_INCREMENT PRIMARY KEY,
      classId INT NOT NULL,
      studentId VARCHAR(20) NOT NULL,
      studentName VARCHAR(100),
      studentEmail VARCHAR(100),
      addedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      FOREIGN KEY (classId) REFERENCES classes(classId) ON DELETE CASCADE,
      FOREIGN KEY (studentId) REFERENCES users(id) ON DELETE CASCADE
);

SELECT * FROM students;
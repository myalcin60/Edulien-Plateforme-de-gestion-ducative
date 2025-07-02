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

SELECT * FROM users  WHERE email='student@gmail.com';

CREATE Table classes (
    classId INT AUTO_INCREMENT PRIMARY KEY,
    className VARCHAR(100) NOT NULL,
    teacherId VARCHAR(20) NOT NULL,   
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacherId) REFERENCES users (id) ON DELETE CASCADE
);

SELECT * FROM classes;

SELECT * FROM classes
WHERE classId = 1;



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

SELECT cl.classId, className FROM classes as cl
JOIN students as st on  cl.`classId`=st.`classId`
where st.`studentId` = 'S_16382';

SELECT * FROM classes as cl
JOIN students as st on  cl.`classId`=st.`classId`
where st.`studentId` = 'S_16382';
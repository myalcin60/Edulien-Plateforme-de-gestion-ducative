-- Active: 1751571723856@@127.0.0.1@3306@edu
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

SELECT * FROM users  WHERE email='s_2@gmail.com';

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
where st.`studentId` = 'S_90744';

SELECT * FROM classes as cl
JOIN students as st on  cl.`classId`=st.`classId`
where st.`studentId` = 'S_46929';

INSERT INTO students ( classId, studentId, studentName, studentEmail ) values ( 4, 'S_46930', 's_3', 's_3@gmail.com');

SELECT studentId, studentName, studentEmail FROM classes as cl
JOIN students as st on  cl.`classId`=st.`classId`
where cl.`className` = 'DWWB';

SELECT studentId, studentName, studentEmail FROM students as st, classes as cl
WHERE cl.`classId`=st.`classId` AND cl.`className` = 'DWWB' ;

SELECT studentId, studentName, studentEmail FROM students as st, classes as cl
WHERE cl.`classId`=1 AND st.`classId`=1  ;

Delete from students
        where classId= 1 and studentId= 'S_46929';
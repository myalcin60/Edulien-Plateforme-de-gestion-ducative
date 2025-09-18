-- Active: 1757782397363@@127.0.0.1@3306@edu
-- Active: 1754772058359@@127.0.0.1@3306@edu
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

ALTER TABLE users ADD COLUMN profile_photo VARCHAR(255);
ALTER TABLE users ADD COLUMN specialization VARCHAR(250);

ALTER TABLE users ADD COLUMN gender VARCHAR(25);

ALTER TABLE users MODIFY COLUMN profile_photo LONGBLOB;

ALTER TABLE users ADD COLUMN profile_photo_type VARCHAR(50);

CREATE Table classes (
    classId INT AUTO_INCREMENT PRIMARY KEY,
    className VARCHAR(100) NOT NULL,
    teacherId VARCHAR(20) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacherId) REFERENCES users (id) ON DELETE CASCADE
);

SELECT * FROM classes;

SELECT * FROM classes WHERE classId = 42;

# bu kullanilmiyor
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

CREATE TABLE lessons (
    lessonId INT AUTO_INCREMENT PRIMARY KEY,
    lessonName VARCHAR(100),
    teacherId VARCHAR(250) NOT NULL,
    classId INT not NULL,
    addedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacherId) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (classId) REFERENCES classes (classId) ON DELETE CASCADE
);

SELECT * FROM lessons;
SELECT * FROM lessons WHERE teacherId='T_70453' and classId=42;
SELECT * FROM lessons WHERE classId = 42;

select * from users;
CREATE TABLE lesson_students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lessonId INT NOT NULL,
    studentId VARCHAR(20) NOT NULL,
    studentName VARCHAR(100),
    studentEmail VARCHAR(100),
    classId INT not NULL,
    addedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lessonId) REFERENCES lessons (lessonId) ON DELETE CASCADE,
    FOREIGN KEY (studentId) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (classId) REFERENCES classes (classId) ON DELETE CASCADE
);

SELECT classId FROM lesson_students where studentEmail='student@gmail.com';

SELECT l.lessonId, lessonName, us.first_name, us.last_name
FROM
    lessons as l
    JOIN lesson_students as st on l.lessonId = st.lessonId
    Join users as us on l.teacherId = us.id
where
    st.studentId = 'S_19688';

SELECT *FROM
    lesson_students as l
    JOIN classes as cl on l.classId = cl.`classId`
    JOIN users as u on u.id = cl.`teacherId`
WHERE
    l.studentId = 'S_19688';
    SELECT * from lessons
    where lessonId = 7;

SELECT * FROM homeworks;

SELECT * from homeworks WHERE `teacherId` = 'T_70453' GROUP BY title;
SELECT * from classes;
SELECT * from classes where classId = 38;

SELECT * FROM users;

SELECT * FROM homeworks WHERE `studentId` = 'S_72053';

CREATE TABLE homeworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacherId VARCHAR(20) NOT NULL,
    studentId VARCHAR(20) NOT NULL,
    classId INT NOT NULL,
    lessonId INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    filePath VARCHAR(255) NULL,
    fileType VARCHAR(20) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (teacherId) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (studentId) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (classId) REFERENCES classes (classId) ON DELETE CASCADE,
    FOREIGN KEY (lessonId) REFERENCES lessons (lessonId) ON DELETE CASCADE
);
use edu;
SELECT * FROM homeworks;

SELECT *
FROM
    lesson_students AS ls
    JOIN lessons AS l ON ls.lessonId = l.lessonId
WHERE
    l.lessonId = 27;

INSERT INTO
    lesson_students (
        lessonId,
        studentId,
        studentEmail,
        studentName,
        classId
    )
values (
        10,
        'S_72053',
        'student',
        'student@gmail.com',
        23
    );

SELECT * FROM lesson_students;

SELECT * from lessons;

SELECT * FROM lessons WHERE `classId` = 21;

SELECT * FROM students;

SELECT cl.classId, className
FROM classes as cl
    JOIN students as st on cl.`classId` = st.`classId`
where
    st.`studentId` = 'S_90744';

SELECT *
FROM classes as cl
    JOIN students as st on cl.`classId` = st.`classId`
where
    st.`studentId` = 'S_46929';

-- yeni sorgu

SELECT l.lessonId, lessonName, us.first_name, us.last_name
FROM
    lessons as l
    JOIN lesson_students as st on l.lessonId = st.lessonId
    Join users as us on l.teacherId = us.id
where
    st.studentId = 'S_72053';
SELECT * from lesson_students;
    SELECT * from lesson_students
        where studentEmail = 'student@gmail.com' and lessonId=8 ;

INSERT INTO
    students (
        classId,
        studentId,
        studentName,
        studentEmail
    )
values (
        4,
        'S_46930',
        's_3',
        's_3@gmail.com'
    );

SELECT
    studentId,
    studentName,
    studentEmail
FROM classes as cl
    JOIN students as st on cl.`classId` = st.`classId`
where
    cl.`className` = 'DWWB';

SELECT
    studentId,
    studentName,
    studentEmail
FROM students as st, classes as cl
WHERE
    cl.`classId` = st.`classId`
    AND cl.`className` = 'DWWB';

SELECT
    studentId,
    studentName,
    studentEmail
FROM students as st, classes as cl
WHERE
    cl.`classId` = 1
    AND st.`classId` = 1;

Delete from students
where
    classId = 1
    and studentId = 'S_46929';

SELECT * from lesson_students where studentEmail = 'eleve@gmail.com';
use edu;
SELECT * FROM lessons;
SELECT * FROM classes;
SELECT classId FROM lesson_students where studentEmail = 'eleve@gmail.com';
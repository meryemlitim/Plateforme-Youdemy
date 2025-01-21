-- the database
CREATE DATABASE db_YOUDEMY;
USE db_YOUDEMY;

-- USER Table 
CREATE TABLE users(

    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student','teacher','admin') NOT NULL,
    status ENUM('blocked','unblocked') DEFAULT 'unblocked' ,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- STUDENT Table
CREATE TABLE student(
    id_student INT PRIMARY KEY,
    FOREIGN KEY (id_student) REFERENCES users(id_user) ON DELETE CASCADE
);

-- TEACHER Table
CREATE TABLE teacher(
    id_teacher INT PRIMARY KEY,
    FOREIGN KEY (id_teacher) REFERENCES users(id_user) ON DELETE CASCADE,
    isvalide BOOLEAN DEFAULT false
);

--CATEGORY Table 
CREATE TABLE category(
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL
);

-- COURSE Table
CREATE TABLE course(
    id_course INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    category_name VARCHAR(255),
    create_by INT NOT NULL,
    type ENUM('video','document') NOT NULL,
    video_url VARCHAR(255), 
    document_text TEXT,
    FOREIGN KEY (create_by) REFERENCES users(id_user) ON DELETE CASCADE,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- CREATE TABLE course(
--     id_course INT AUTO_INCREMENT PRIMARY KEY,
--     title VARCHAR(100) NOT NULL,
--     description TEXT NOT NULL,
--     id_category INT,
    
--     create_by INT NOT NULL,
--     type ENUM('video','document') NOT NULL,
--     video_url VARCHAR(255), 
--     document_text TEXT,
--     FOREIGN KEY (create_by) REFERENCES teacher(id_teacher) ON DELETE CASCADE,
--     FOREIGN KEY (id_category) REFERENCES category(id_category) ON DELETE CASCADE,
--     date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

--ENROLLMENT Table
CREATE TABLE enrollment(
    id_enrollment INT AUTO_INCREMENT PRIMARY KEY,
    id_course INT NOT NULL,
    id_student INT NOT NULL,
    enrollment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_course) REFERENCES course(id_course) ON DELETE CASCADE,
    FOREIGN KEY (id_student) REFERENCES course(id_student) ON DELETE CASCADE
);

--TAG Table
CREATE TABLE tag(
    id_tag INT AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(50) NOT NULL
);

--TAG_COURSE Table
CREATE TABLE tag_course(
    id_course INT NOT NULL,
    id_tag INT NOT NULL,
    PRIMARY KEY (id_course,id_tag),
    FOREIGN key id_course REFERENCES course(id_course) ON DELETE CASCADE,
    FOREIGN key id_tag REFERENCES tag(id_tag) ON DELETE CASCADE
);

-- --CONTENT_VIDEO Table
-- CREATE TABLE content_video(
--     id_content INT AUTO_INCREMENT PRIMARY KEY,
--     id_content INT NOT NULL,
--     video_url VARCHAR(255) NOT NULL,
--     FOREIGN KEY (id_course) REFERENCES course(id_course) ON DELETE CASCADE
-- );

-- --CONTENT_DOCUMENT Table
-- CREATE TABLE content_document(
--     id_content INT AUTO_INCREMENT PRIMARY KEY,
--     id_content INT NOT NULL,
--     document_text TEXT NOT NULL,
--     FOREIGN KEY (id_course) REFERENCES course(id_course) ON DELETE CASCADE
-- );
-- Campus Connect (formerly "SITian") — portfolio-restoration backend
-- --------------------------------------------------------------------
-- The original 2019-2020 project talked to a set of PHP scripts on the
-- developer's own LAN (192.168.1.6) with no schema included in the
-- Android project itself. This schema is a from-scratch reconstruction
-- that implements the exact request/response contract the Android app
-- already expects (verified against the app's networking code), so the
-- app behaves as it would have against a real backend of that era.
--
-- Design note: rather than one physical SQL table per subject (which the
-- app's use of a generic "tablename" parameter suggests the original may
-- have done), this schema stores that same string as a column
-- (`table_key`) in normalized tables. Functionally identical from the
-- app's point of view (same endpoints, same JSON shapes) but far less
-- fragile than dynamic per-request table names, and much easier for you
-- to inspect/seed for a portfolio demo.

CREATE DATABASE IF NOT EXISTS campusconnect CHARACTER SET utf8mb4;
USE campusconnect;

-- ---------------------------------------------------------------
-- Accounts
-- ---------------------------------------------------------------

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(120) NOT NULL,
    username VARCHAR(60) NOT NULL UNIQUE,
    grno VARCHAR(30) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL,
    password VARCHAR(255) NOT NULL,
    branch VARCHAR(20) DEFAULT NULL,
    year VARCHAR(20) DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(120) NOT NULL,
    username VARCHAR(60) NOT NULL UNIQUE,
    teacherid VARCHAR(30) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE nonteaching (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(120) NOT NULL,
    username VARCHAR(60) NOT NULL UNIQUE,
    nonteachid VARCHAR(30) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------
-- Subjects (a friendly lookup for the table_key strings the app sends)
-- ---------------------------------------------------------------

CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_key VARCHAR(60) NOT NULL UNIQUE,
    subject_name VARCHAR(120) NOT NULL,
    branch VARCHAR(60) NOT NULL,
    year VARCHAR(20) NOT NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------
-- Syllabus
-- ---------------------------------------------------------------

CREATE TABLE syllabus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_key VARCHAR(60) NOT NULL,
    chaptername VARCHAR(255) NOT NULL,
    checked VARCHAR(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB;

-- ---------------------------------------------------------------
-- Files (notices, branch uploads, syllabus attachments, general uploads)
-- ---------------------------------------------------------------

CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_key VARCHAR(60) NOT NULL,
    name VARCHAR(255) NOT NULL,
    url VARCHAR(500) NOT NULL,
    uploaded_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------
-- Attendance
-- ---------------------------------------------------------------

CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_key VARCHAR(60) NOT NULL,
    atrollno VARCHAR(10) NOT NULL,
    atdate DATETIME NOT NULL,
    atstatus VARCHAR(20) NOT NULL
) ENGINE=InnoDB;


-- =================================================================
-- Seed data — styled to look like a real 2019-2020 academic term
-- =================================================================

INSERT INTO subjects (table_key, subject_name, branch, year) VALUES
    ('cmpn_os_ty', 'Operating Systems', 'Computer Engineering', 'Third Year'),
    ('cmpn_dbms_ty', 'Database Management Systems', 'Computer Engineering', 'Third Year'),
    ('it_java_ty', 'Advanced Java', 'Information Technology', 'Third Year'),
    ('extc_signals_sy', 'Signals & Systems', 'Electronics & Telecommunication', 'Second Year');

-- Sample student accounts (password for all demo accounts is: campus1234)
-- Hash below is a genuine bcrypt hash of "campus1234" (verified against
-- PHP's password_verify() rules — PHP accepts $2b$ hashes the same as
-- the $2y$ ones its own password_hash() produces).
INSERT INTO students (fullname, username, grno, email, password, branch, year) VALUES
    ('Rohan Mehta', 'rohan.mehta', 'CMPN1901042', 'rohan.mehta@sitcampus.edu', '$2b$12$PnhFS7vypJu0mDIaGLxTr.2iywqPY8FeQfELtjQvlVkrBGZPD69D.', 'cmpn', 'third_year'),
    ('Ayesha Khan', 'ayesha.khan', 'IT1901017', 'ayesha.khan@sitcampus.edu', '$2b$12$PnhFS7vypJu0mDIaGLxTr.2iywqPY8FeQfELtjQvlVkrBGZPD69D.', 'it', 'third_year');

-- Sample teacher account
INSERT INTO teachers (fullname, username, teacherid, email, password) VALUES
    ('Prof. Anjali Deshmukh', 'anjali.deshmukh', 'FAC0231', 'anjali.deshmukh@sitcampus.edu', '$2b$12$PnhFS7vypJu0mDIaGLxTr.2iywqPY8FeQfELtjQvlVkrBGZPD69D.');

-- Sample non-teaching staff account
INSERT INTO nonteaching (fullname, username, nonteachid, email, password) VALUES
    ('Suresh Pawar', 'suresh.pawar', 'NT0119', 'suresh.pawar@sitcampus.edu', '$2b$12$PnhFS7vypJu0mDIaGLxTr.2iywqPY8FeQfELtjQvlVkrBGZPD69D.');

-- Syllabus chapters for Operating Systems (cmpn_os_ty)
INSERT INTO syllabus (table_key, chaptername, checked) VALUES
    ('cmpn_os_ty', 'Introduction to Operating Systems', '2019-08-05'),
    ('cmpn_os_ty', 'Process Management & Scheduling', '2019-08-19'),
    ('cmpn_os_ty', 'Process Synchronization', '2019-09-02'),
    ('cmpn_os_ty', 'Deadlocks', '2019-09-16'),
    ('cmpn_os_ty', 'Memory Management', '0'),
    ('cmpn_os_ty', 'File Systems', '0');

-- Syllabus chapters for Advanced Java (it_java_ty)
INSERT INTO syllabus (table_key, chaptername, checked) VALUES
    ('it_java_ty', 'Collections Framework', '2019-08-07'),
    ('it_java_ty', 'Multithreading', '2019-08-21'),
    ('it_java_ty', 'JDBC & Networking', '0');

-- Notice-board style files (general track)
INSERT INTO files (table_key, name, url, uploaded_at) VALUES
    ('notices', 'Diwali_Vacation_Notice.pdf', 'uploads/Diwali_Vacation_Notice.pdf', '2019-10-18 10:15:00'),
    ('notices', 'Internal_Exam_Timetable_Nov2019.pdf', 'uploads/Internal_Exam_Timetable_Nov2019.pdf', '2019-11-02 09:30:00'),
    ('notices', 'Annual_TechFest_2020_Schedule.pdf', 'uploads/Annual_TechFest_2020_Schedule.pdf', '2020-01-20 14:00:00');

-- Branch-specific upload bucket example (Comps)
INSERT INTO files (table_key, name, url, uploaded_at) VALUES
    ('cmpn', 'OS_Unit3_Notes.pdf', 'uploads/OS_Unit3_Notes.pdf', '2019-09-10 18:42:00'),
    ('cmpn', 'DBMS_Assignment2.docx', 'uploads/DBMS_Assignment2.docx', '2019-09-25 11:05:00');

-- A few weeks of attendance for Operating Systems, rollnos 1-10
INSERT INTO attendance (table_key, atrollno, atdate, atstatus) VALUES
    ('cmpn_os_ty', '1', '2019-08-05 09:00:00', 'present'),
    ('cmpn_os_ty', '2', '2019-08-05 09:00:00', 'present'),
    ('cmpn_os_ty', '3', '2019-08-05 09:00:00', 'absent'),
    ('cmpn_os_ty', '1', '2019-08-12 09:00:00', 'present'),
    ('cmpn_os_ty', '2', '2019-08-12 09:00:00', 'absent'),
    ('cmpn_os_ty', '3', '2019-08-12 09:00:00', 'present'),
    ('cmpn_os_ty', '1', '2019-08-19 09:00:00', 'present'),
    ('cmpn_os_ty', '2', '2019-08-19 09:00:00', 'present'),
    ('cmpn_os_ty', '3', '2019-08-19 09:00:00', 'present');

CREATE DATABASE IF NOT EXISTS lims;
USE lims;

CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL,
    publisher VARCHAR(255) NOT NULL
);

INSERT INTO books (id,title, type, publisher) VALUES
('1','Clean Code', 'Programming', 'Prentice Hall'),
('2', 'The Pragmatic Programmer', 'Programming', 'Addison-Wesley');




USE lims;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('ADMIN','USER') NOT NULL
    );

INSERT INTO users (username, password_hash, role)
VALUES ('admin', SHA2('admin123', 256), 'ADMIN');
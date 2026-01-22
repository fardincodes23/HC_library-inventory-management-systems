CREATE DATABASE IF NOT EXISTS lims;
USE lims;

CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL,
    publisher VARCHAR(255) NOT NULL
);

INSERT INTO books (title, type, publisher) VALUES
('Clean Code', 'Programming', 'Prentice Hall'),
('The Pragmatic Programmer', 'Programming', 'Addison-Wesley');

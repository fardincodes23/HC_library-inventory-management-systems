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

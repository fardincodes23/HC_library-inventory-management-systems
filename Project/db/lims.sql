-- LIMS database script (schema)

CREATE DATABASE IF NOT EXISTS lims
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE lims;

-- Drop existing tables only if you want a clean reset
-- DROP TABLE IF EXISTS loans;
-- DROP TABLE IF EXISTS books;
-- DROP TABLE IF EXISTS clients;
-- DROP TABLE IF EXISTS users;
-- DROP TABLE IF EXISTS suppliers;

CREATE TABLE IF NOT EXISTS suppliers (
                                         id INT AUTO_INCREMENT PRIMARY KEY,
                                         name VARCHAR(100) NOT NULL,
    contactinfo VARCHAR(150) NULL
    );

CREATE TABLE IF NOT EXISTS books (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     title VARCHAR(150) NOT NULL,
    type VARCHAR(50) NOT NULL,
    publisher VARCHAR(100) NOT NULL,
    supplier_id INT NULL,
    CONSTRAINT fk_books_supplier
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
    ON DELETE SET NULL
    );

CREATE TABLE IF NOT EXISTS clients (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL
    );

CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('ADMIN','USER') NOT NULL DEFAULT 'USER'
    );

CREATE TABLE IF NOT EXISTS loans (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     book_id INT NOT NULL,
                                     client_id INT NOT NULL,
                                     loan_date DATE NOT NULL,
                                     due_date DATE NOT NULL,
                                     return_date DATE NULL,
                                     CONSTRAINT fk_loans_book
                                     FOREIGN KEY (book_id) REFERENCES books(id)
    ON DELETE RESTRICT,
    CONSTRAINT fk_loans_client
    FOREIGN KEY (client_id) REFERENCES clients(id)
    ON DELETE RESTRICT
    );

-- Seed admin user (password: admin123)
INSERT INTO users (username, password_hash, role)
VALUES ('admin', SHA2('admin123', 256), 'ADMIN')
    ON DUPLICATE KEY UPDATE username = username;

-- Optional: sample books
INSERT INTO books (title, type, publisher)
VALUES
    ('Clean Code', 'Programming', 'Prentice Hall'),
    ('The Pragmatic Programmer', 'Programming', 'Addison-Wesley'),
    ('Java', 'Programming', 'Fardin');

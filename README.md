# Library Information Management System (LIMS)

**Library Information Management System (LIMS)** is a PHP + MariaDB web application that manages a library’s book inventory. Currently in its first iteration, it supports inventory management and is structured to support client and loan records in future updates.

It is developed as part of the **CIS‑2261 Application Development** course and runs locally on XAMPP using PHP and MySQLi.

## 👥 Contributors

* **Project Manager:** Farhan
* **Developer / Database:** Fardin

---

## ✨ Features (Iteration One)

**Manage book inventory:**
* Add new books with title, type, and publisher.
* View and list all books in the system.

**Structured for future features:**
* Client management (CRUD).
* Loan and overdue tracking.
* Role‑based security (Admin vs Staff vs Client).

> **Note:** Loan management, overdue notifications, and full client self‑service are planned for later iterations and are not included in Iteration One.

---

## 🛠️ Technology Stack

* **Language:** PHP (PHP 8.x recommended)
* **Web Server:** Apache (via XAMPP)
* **Database:** MariaDB (MySQL‑compatible)
* **Database Access:** MySQLi with prepared statements
* **Environment:** Local development on XAMPP (Windows)

---

## 📂 Project Structure

The repository is organized to keep configuration, controllers, models, and views clearly separated:

* **lims/**
    * `index.php` — Front controller / router
    * **config/**
        * `config.php` — Base paths, session, constants
        * `database.php` — MySQLi connection (MariaDB)
    * **controllers/**
        * `BookController.php` — Book-related HTTP actions
        * *(Future: ClientController.php, AuthController.php)*
    * **models/**
        * `Book.php` — Book data access (DAO)
        * *(Future: Client.php, Loan.php)*
    * **views/**
        * **layout/**
            * `header.php` — Common header & navigation
            * `footer.php` — Common footer
        * **books/**
            * `list.php` — Book list view
            * `create.php` — Book creation form
    * **sql/**
        * `lims_schema.sql` — Database schema & sample data

This layout mirrors a simple MVC‑style pattern, similar in spirit to a Spring Boot project but implemented manually in PHP.

---

## 🚀 Getting Started

### Prerequisites
* XAMPP installed (Apache + MariaDB + PHP).
* A web browser (Chrome, Edge, Firefox, etc.).

### Installation
1.  **Clone or copy the project** into your XAMPP web root:
    `C:\xampp\htdocs\lims`
2.  **Verify the base URL** in `config/config.php` matches the folder name:
    `define('BASE_URL', '/lims');`

### Database Setup
1.  Start **Apache** and **MySQL** from the XAMPP control panel.
2.  Open **phpMyAdmin** at: `http://localhost/phpmyadmin`
3.  **Import the schema:**
    * Use the **Import** tab and select `sql/lims_schema.sql`, or
    * Manually run the contents of `lims_schema.sql` in the SQL tab.
4.  **Result:**
    * Creates a `lims` database.
    * Creates a `books` table.
    * Inserts sample book records.

### Configuration
* **config/config.php:** Sets base paths and starts the PHP session.
* **config/database.php:** Defines the MySQLi connection parameters.
    ```php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'lims';
    ```
    *(Adjust these if your local setup is different)*

---

## 🖥️ Running the Application

1.  Ensure **Apache** and **MySQL** are running in XAMPP.
2.  Navigate to the application in your browser:
    `http://localhost/lims/index.php`
3.  **Usage:**
    * The default route calls `BookController::index()` and displays the book inventory list.
    * Use the **“Add New Book”** link to open the create form and add new books to the database.

---

## 🏗️ Architecture Overview

The application uses a simple layered design:

* **Front Controller / Router (`index.php`):**
    Reads `controller` and `action` query parameters and forwards the request (e.g., `index.php?controller=book&action=create`).
* **Controller Layer (`controllers/`):**
    Contains request‑handling classes. `BookController` retrieves data from models and loads views.
* **Model / Data Access Layer (`models/`):**
    Encapsulates all SQL queries using MySQLi prepared statements (e.g., `Book::getAll()`).
* **View Layer (`views/`):**
    Contains HTML/PHP templates. Layout files (`header.php`, `footer.php`) wrap the page content.

---

## 📝 Extending the Project

Planned next steps for future iterations:

* **Client Management:** `Client.php`, `ClientController.php`, and views.
* **Loans & Overdue Tracking:** `Loan.php`, `LoanController.php`, and views.
* **Authentication & Roles:** `AuthController.php`, `login.php`, and session checks.

### Known Limitations
* Authentication and role‑based security are not yet implemented.
* Error handling and security (CSRF, input validation) are basic.
* Styling is minimal; focus is on structure and functionality.
# Library Information Management System (LIMS)

**Project Manager:** Fardin Sahriar AL Rafat  
**Developer:** Farhan Farhan  

**Tech Stack:** PHP, MySQL, HTML, CSS (Bootstrap)  

---

## Project Overview
The Library Information Management System (LIMS) is a secure, relational database web application designed for library staff to manage daily operations. It features a fully connected relational database enforcing strict data integrity (Foreign Keys, Cascading rules) to ensure accurate record-keeping.

## Core Features
* **Secure Staff Authentication:** Encrypted password hashing (Bcrypt) and role-based session management.
* **Book Inventory:** Track books, genres, and publishers.
* **Supplier Directory:** Manage publishing companies, automatically linked to the books they supply using relational queries.
* **Client Management:** Add and update library members safely.
* **Loan Registry:** Check books in and out, with built-in safeguards preventing the deletion of actively checked-out books or clients.
* **Overdue Books Report:** A dynamically calculated report that uses `DATEDIFF()` to flag late returns and calculate days overdue.

---

## Installation & Setup Instructions
To test and grade this application locally, please follow these steps:

### 1. Folder Placement
Place the extracted `LIMS` project folder into your local server's web directory (e.g., `C:\xampp\htdocs\LIMS`).

### 2. Database Import
1. Open phpMyAdmin (`http://localhost/phpmyadmin`).
2. Create a brand new, empty database named exactly: `lims`
3. Click on the `lims` database and go to the **Import** tab.
4. Choose the `lims.sql` file provided in the root of this project folder and click **Import**.

> **Note:** This file contains the complete table structures, foreign key constraints, and pre-populated sample data.

---

## System Access (Credentials)
Because the application uses highly secure password hashing, you cannot log in with plaintext database entries. A seeded Admin account has been pre-configured in the `lims.sql` export for your convenience.

Please use the following credentials to access the system:

* **Username:** `admin`
* **Password:** `admin123`
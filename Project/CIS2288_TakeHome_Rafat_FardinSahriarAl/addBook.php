<?php
/**
 * Filename: addBook.php
 * @author:   Fardin
 * @since:    Dec 10, 2025
 * Purpose:  Process the insert operation with Duplicate Check.
 */

session_start();
if (!isset($_SESSION['valid_user'])) {
    header("location: login.php");
    exit();
}
require_once("lib/config.php");

if (isset($_POST['submit'])) {
    $isbn = trim($_POST['isbn']);
    $author = trim($_POST['author']);
    $title = trim($_POST['title']);
    $price = trim($_POST['price']);

    if (empty($isbn) || empty($author) || empty($title) || empty($price)) {
        header("location: newBook.php?error=empty");
        exit();
    }
    $stmt = $mysqli->prepare("INSERT INTO books (isbn, author, title, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $isbn, $author, $title, $price);

    try {
        if ($stmt->execute()) {
            $stmt->close();
            $mysqli->close();
            header("location: index.php?msg=Book added successfully");
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            $stmt->close();
            $mysqli->close();
            header("location: newBook.php?error=duplicate");
            exit();
        } else {
            $stmt->close();
            $mysqli->close();
            header("location: newBook.php?error=db");
            exit();
        }
    }

} else {
    header("location: newBook.php");
    exit();
}
?>
<?php
/**
 * Filename: updateBook.php
 * @author:   Fardin
 * @since:    Dec 10, 2025
 * Purpose:  Process the update operation with Duplicate Check.
 */

session_start();
if (!isset($_SESSION['valid_user'])) {
    header("location: login.php");
    exit();
}

require("lib/config.php");

if (isset($_POST['submit'])) {
    $bookId = $mysqli->real_escape_string($_POST['bookId']);
    $isbn = $mysqli->real_escape_string($_POST['isbn']);
    $author = $mysqli->real_escape_string($_POST['author']);
    $title = $mysqli->real_escape_string($_POST['title']);
    $price = doubleval($_POST['price']);
    if (empty($isbn) || empty($author) || empty($title)) {
        echo "Error: All fields are required. <a href='editBook.php?bookId=$bookId'>Go Back</a>";
        exit;
    }
    $query = "UPDATE books SET isbn='$isbn', title='$title', author='$author', price=$price WHERE id=$bookId";
    try {
        if ($mysqli->query($query)) {
            header("location: index.php?msg=Book updated successfully");
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            header("location: editBook.php?bookId=$bookId&error=duplicate");
        } else {
            echo "Database Error: " . $e->getMessage();
        }
    }
    $mysqli->close();
} else {
    header("location: index.php");
}
?>
<?php
/**
 * Filename: delete.php
 * @author:   Fardin
 * @since:    Dec 10, 2025
 * Purpose:  Process the delete operation. Protected page.
 */

session_start();
if (!isset($_SESSION['valid_user'])) {
    header("location: login.php");
    exit();
}

require_once("lib/config.php");

if (isset($_GET["bookId"]) && !empty($_GET["bookId"])) {
    $bookId = $mysqli->real_escape_string($_GET['bookId']);
    $query = "DELETE FROM books WHERE id = $bookId";

    if ($mysqli->query($query)) {
        header("location: index.php?msg=Book deleted successfully");
    } else {
        header("location: index.php?msg=Error deleting record");
    }

    $mysqli->close();
} else {
    header("location: index.php");
}
?>
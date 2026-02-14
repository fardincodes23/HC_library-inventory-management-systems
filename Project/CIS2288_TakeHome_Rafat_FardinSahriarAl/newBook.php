<?php
/**
 * Filename: newBook.php
 * @author:   Fardin
 * @since:    Dec 11, 2025
 * Purpose:  Form to add a new book to the database. Protected page.
 */

session_start();
if (!isset($_SESSION['valid_user'])) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <h1>Book-O-Rama - New Book</h1>
            </div>
            <div class="col-md-4 text-right" style="margin-top: 20px;">
                <p class="text-success">
                    Logged in as: <strong><?php echo $_SESSION['valid_user']; ?></strong>
                </p>
                <a href="index.php" class="btn btn-default btn-sm">Back to List</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-md-offset-3">

        <?php
        if (isset($_GET["error"])) {
            echo "<div class='alert alert-danger'>";
            if ($_GET["error"] == 'empty') {
                echo "Error: All fields are required.";
            } elseif ($_GET["error"] == 'duplicate') {
                echo "Error: That ISBN already exists.";
            } elseif ($_GET["error"] == 'db') {
                echo "Database Error: Could not add book.";
            }

            echo "</div>";
        }
        ?>

        <form action="addBook.php" method="post" class="well">
            <div class="form-group">
                <label for="isbn">ISBN (e.g. 0-672-31509-2):</label>
                <input type="text" class="form-control" id="isbn" name="isbn" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="price">Price ($):</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Add Book</button>
        </form>
    </div>
</div>
</body>
</html>
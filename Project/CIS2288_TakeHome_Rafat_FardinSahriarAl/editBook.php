<?php
/**
 * Filename: editBook.php
 * @author:   Fardin
 * @since:     Dec 11, 2025
 * Purpose:  Form to edit existing book. Pre-filled with data. Protected.
 */

session_start();
if (!isset($_SESSION['valid_user'])) {
    header("location: login.php");
    exit();
}

require("lib/config.php");

$message = "";
$book = null;

if (isset($_GET['bookId'])) {
    $bookId = $mysqli->real_escape_string($_GET['bookId']);
    $query = "SELECT * FROM books WHERE id = $bookId";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        $message = "Book not found.";
    }
    $result->free();
} else {
    $message = "No ID provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <h1>Book-O-Rama -Edit Book</h1>
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
        <?php if ($message) echo "<div class='alert alert-danger'>$message</div>"; ?>

        <?php
        if (isset($_GET["error"])) {
            echo "<div class='alert alert-danger'>";
            if ($_GET["error"] == 'duplicate') echo "Error: That ISBN is already taken by another book.";
            if ($_GET["error"] == 'db') echo "Database Error: Could not update book.";
            echo "</div>";
        }
        ?>
        <?php if ($book): ?>
            <form action="updateBook.php" method="post" class="well">
                <div class="form-group">
                    <label>Book ID (Read Only):</label>
                    <input type="text" class="form-control" value="<?php echo $book['id']; ?>" disabled>
                    <input type="hidden" name="bookId" value="<?php echo $book['id']; ?>">
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" name="isbn" value="<?php echo htmlspecialchars($book['isbn']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Price ($):</label>
                    <input type="number" step="0.01" class="form-control" name="price" value="<?php echo htmlspecialchars($book['price']); ?>" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary btn-block">Update Book</button>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
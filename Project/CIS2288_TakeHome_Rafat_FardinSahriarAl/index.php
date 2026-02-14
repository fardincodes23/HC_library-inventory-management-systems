<?php
/**
 * Filename: index.php
 * @author:   Fardin
 * @since:     Dec 10, 2025
 * Purpose:  Display book inventory with sorting and admin controls.
 */

global $mysqli;
session_start();
require_once("lib/config.php");
$orderBy = "title";
$sortDir = "ASC";

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    if ($sort == 'author') $orderBy = "author";
    if ($sort == 'price') $orderBy = "price";
    if ($sort == 'title') $orderBy = "title";
}

$query = "SELECT id, isbn, author, title, price FROM books ORDER BY $orderBy $sortDir";
$result = $mysqli->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book-O-Rama Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
        }
        .table-header-link {
            color: whitesmoke;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h1>CIS Book Inventory</h1>
        </div>
        <div class="col-md-4 text-right" style="margin-top: 20px;">
            <?php if (isset($_SESSION['valid_user'])): ?>
                <p class="text-success">Logged in as:
                    <strong><?php echo htmlspecialchars($_SESSION['valid_user']); ?></strong></p>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary btn-sm">Login (Admin)</a>
            <?php endif; ?>
        </div>
    </div>
    <hr>

    <?php
    if (isset($_GET['msg'])) {
        echo "<div class='alert alert-info'>" . htmlspecialchars($_GET['msg']) . "</div>";
    }

    if ($result) {
        $numResults = $result->num_rows;
        echo "<p>Number of books found: " . $numResults . "</p>";

        if ($numResults > 0) {
            $books = $result->fetch_all(MYSQLI_ASSOC);

            echo "<table class='table table-bordered table-striped'>";
            echo "<thead><tr>";
            echo "<th>ID</th>";
            echo "<th>ISBN</th>";
            echo "<th><a href='index.php?sort=author' title='Sort by Author'>Author</a></th>";
            echo "<th><a href='index.php?sort=title' title='Sort by Title'>Title (Default)</a></th>";
            echo "<th><a href='index.php?sort=price' title='Sort by Price'>Price</a></th>";

            if (isset($_SESSION['valid_user'])) {
                echo "<th>Actions</th>";
            }
            echo "</tr></thead><tbody>";
            foreach ($books as $book) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($book['id']) . "</td>";
                echo "<td>" . htmlspecialchars($book['isbn']) . "</td>";
                echo "<td>" . htmlspecialchars($book['author']) . "</td>";
                echo "<td>" . htmlspecialchars($book['title']) . "</td>";
                echo "<td>$" . htmlspecialchars($book['price']) . "</td>";

                if (isset($_SESSION['valid_user'])) {
                    echo "<td>";
                    echo "<a href='editBook.php?bookId=" . $book['id'] . "' class='btn btn-info btn-xs' style='margin-right:5px;'>Edit</a>";
                    echo "<a href='delete.php?bookId=" . $book['id'] . "' class='btn btn-danger btn-xs' onclick=\"return confirm('Are you sure?');\">Delete</a>";
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>No books found.</div>";
        }
        $result->free();
    } else {
        echo "<div class='alert alert-danger'>Error retrieving data.</div>";
    }
    if (isset($_SESSION['valid_user'])) {
        echo "<div class='well'>";
        echo "<a href='newBook.php' class='btn btn-success'>Add a New Book</a>";
        echo "</div>";
    }
    $mysqli->close();
    ?>
</div>
</body>
</html>
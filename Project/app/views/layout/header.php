<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LIMS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; }
        header { background: #333; color: #fff; padding: 10px; }
        nav a { color: #fff; margin-right: 10px; text-decoration: none; }
        .container { padding: 20px; }
        .error { color: red; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; }
    </style>
</head>
<body>
<header>
    <span>LIMS</span>
    <?php if (isset($_SESSION['username'])): ?>
        <nav>
            <a href="index.php">Home</a>
            <a href="index.php?page=books">Books</a>
            <a href="index.php?page=clients">Clients</a>
            <a href="index.php?page=loans">Loans</a>
            <a href="index.php?page=logout">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
        </nav>
    <?php else: ?>
        <nav>
            <a href="index.php">Home</a>
            <a href="index.php?page=login">Staff/Admin Login</a>
        </nav>
    <?php endif; ?>
</header>
<div class="container">

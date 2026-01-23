<?php require_once APP_PATH . '/config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LIMS - Library Information Management System</title>
</head>
<body>
<header>
    <h1>Library Information Management System</h1>
    <nav>
        <a href="<?= BASE_URL ?>/index.php?controller=book&action=index">Books</a>
        <?php if (!empty($_SESSION['user_id'])): ?>
            <span> | Logged in as <?= htmlspecialchars($_SESSION['username']) ?> (<?= htmlspecialchars($_SESSION['role']) ?>)</span>
            <a href="<?= BASE_URL ?>/index.php?controller=auth&action=logout">Logout</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/index.php?controller=auth&action=login">Login</a>
        <?php endif; ?>    </nav>
</header>
<main>

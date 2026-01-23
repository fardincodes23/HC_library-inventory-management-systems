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
        <!-- later: Clients, Loans, Reports, Login -->
    </nav>
</header>
<main>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIMS - Library Inc.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #3a3b3c;">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="font-family: Georgia, serif; color: #c5a059;">📚 LIMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link text-light" href="index.php">Home</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item"><a class="nav-link text-light" href="index.php?page=books">Books</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="index.php?page=clients">Clients</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="index.php?page=loans">Loans</a></li>

                    <?php if (isAdmin()): ?>
                        <li class="nav-item"><a class="nav-link" style="color: #c5a059;" href="index.php?page=register">Add Staff</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link text-light" href="index.php?page=books">Catalog</a></li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav">
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <span class="nav-link text-light">Welcome, <strong style="color: #c5a059;"><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger btn-sm ms-3 mt-1 px-3" href="index.php?page=logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-sm mt-1 shadow-sm fw-bold px-3" style="background-color: #c5a059; color: #fff; border: none;" href="index.php?page=login">Staff Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-5">
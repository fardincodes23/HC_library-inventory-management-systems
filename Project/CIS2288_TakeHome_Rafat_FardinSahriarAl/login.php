<?php
/**
 * Filename: login.php
 * @author:   Fardin
 * @since:     Dec 10, 2025
 * Purpose:  Authenticate admin user with hardcoded credentials.
 */

session_start();
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === 'siteAdminAccount' && $password === 'CISpass') {
        $_SESSION['valid_user'] = $username;
        header("location: index.php");
        exit;
    } else {
        $msg = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book-O-Rama Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        body { padding-top: 40px; background-color: whitesmoke }
        .form-signin { max-width: 330px; padding: 15px; margin: 0 auto; background: whitesmoke; border: 1px solid whitesmoke; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php if($msg) echo "<div class='alert alert-danger'>$msg</div>"; ?>

        <div class="form-group">
            <label for="username" class="sr-only">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <br>
        <a href="index.php">Cancel</a>
    </form>
</div>
</body>
</html>
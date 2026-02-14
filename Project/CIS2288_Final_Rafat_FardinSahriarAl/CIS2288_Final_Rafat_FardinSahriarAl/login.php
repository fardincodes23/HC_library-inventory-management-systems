<?php
/*
 * Filename: login.php
 * Author:   Fardin
 * Date:     Dec 11, 2025
 * Purpose:  Authenticate admin user with hardcoded credentials.
 */
session_start();
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === 'admin' && $password === 'news2288') {
        $_SESSION['valid_user'] = $username;
        header("location: index.php");
        exit;
    } else {
        $msg = "Invalid username or password.";
    }
}
	$pageTitle = "News - Login";
	include ("incPageHead.php");


?>
        <form action="login.php" method="post">
			<div class="form-group">
				<label for="user">Username:</label>
				<input type="text" name="username" id="user" class="form-control"/><br>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" class="form-control"/><br>
				<input type="submit" name="submit" value="Login" class="btn btn-default"/>
			</div>
        </form>
        <?php
            if (isset($error)) {
                echo "<div class='alert alert-danger'>$error</div>";
            }

			include ("incPageFoot.php");
        ?>

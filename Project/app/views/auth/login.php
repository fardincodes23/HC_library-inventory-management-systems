<?php include VIEW_PATH . '/layout/header.php'; ?>

<h2>Login</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="index.php?controller=auth&action=login">
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <button type="submit">Login</button>
        <a href="index.php?controller=auth&action=register">Register</a>
    </div>
</form>

<?php include VIEW_PATH . '/layout/footer.php'; ?>

<?php include VIEW_PATH . '/layout/header.php'; ?>

<h2>Register New User</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p style="color:green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="post" action="index.php?controller=auth&action=register">
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
    </div>
    <div>
        <button type="submit">Register</button>
        <a href="index.php?controller=auth&action=login">Back to Login</a>
    </div>
</form>

<?php include VIEW_PATH . '/layout/footer.php'; ?>

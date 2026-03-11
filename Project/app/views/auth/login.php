<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Login</h2>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="index.php?page=login">
    <label>Username:
        <input type="text" name="username" required>
    </label><br><br>
    <label>Password:
        <input type="password" name="password" required>
    </label><br><br>
    <button type="submit">Login</button>
    <br><br>
    <label>
        <a href="index.php?page=register">Register New Account</a>
    </label>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>

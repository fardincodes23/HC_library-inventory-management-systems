<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Add Client</h2>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="index.php?page=clients_create">
    <label>Name:
        <input type="text" name="name" required>
    </label><br><br>
    <label>Email:
        <input type="email" name="email" required>
    </label><br><br>
    <label>Phone:
        <input type="text" name="phone" required>
    </label><br><br>
    <button type="submit">Save</button>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<?php include VIEW_PATH . '/layout/header.php'; ?>

<h2>Add New Book</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="index.php?controller=book&action=create">
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
    </div>
    <div>
        <label for="type">Type:</label>
        <input type="text" name="type" id="type" required>
    </div>
    <div>
        <label for="publisher">Publisher:</label>
        <input type="text" name="publisher" id="publisher" required>
    </div>
    <div>
        <button type="submit">Save</button>
        <a href="index.php?controller=book&action=index">Cancel</a>
    </div>
</form>

<?php include VIEW_PATH . '/layout/footer.php'; ?>

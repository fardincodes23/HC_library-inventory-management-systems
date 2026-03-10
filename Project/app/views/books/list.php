
<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Book Inventory</h2>

<p>

    <a href="index.php?page=books_create">Add New Book</a>
</p>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Type</th>
        <th>Publisher</th>
    </tr>
    <?php if (!empty($books)): ?>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book['id']) ?></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['type']) ?></td>
                <td><?= htmlspecialchars($book['publisher']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">No books found.</td></tr>
    <?php endif; ?>
</table>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="mb-0 text-secondary" style="font-family: Georgia, serif;">Book Inventory</h2>

        <?php if (isset($_SESSION['username'])): ?>
            <a href="index.php?page=books_create" class="btn shadow-sm px-4" style="background-color: #c5a059; color: #fff; border: none; font-weight: 500;">
                + Add New Book
            </a>
        <?php endif; ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover mb-0 align-middle border-light">
            <thead class="table-secondary text-secondary">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Publisher</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td class="fw-bold text-muted">#<?= htmlspecialchars($book['id']) ?></td>
                        <td class="fw-medium text-dark"><?= htmlspecialchars($book['title']) ?></td>
                        <td><span class="badge" style="background-color: #8a8d91;"><?= htmlspecialchars($book['type']) ?></span></td>
                        <td><?= htmlspecialchars($book['publisher']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center py-4 text-muted">No books found in the catalog.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
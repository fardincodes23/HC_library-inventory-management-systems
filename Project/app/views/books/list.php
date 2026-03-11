<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h2 class="mb-0 text-secondary" style="font-family: Georgia, serif;">Book Inventory</h2>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'in_use'): ?>
        <div class="alert alert-danger shadow-lg border-0 alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index: 1050; width: max-content; max-width: 90vw;" role="alert">
            <strong>⚠️ Action Denied:</strong> Cannot delete this book because it is linked to existing loan history records.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['username'])): ?>
        <a href="index.php?page=books_create" class="btn shadow-sm px-4"
           style="background-color: #c5a059; color: #fff; border: none; font-weight: 500;">
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
            <?php if (isset($_SESSION['username'])): ?>
                <th>Actions</th><?php endif; ?>
        </tr>
        </thead>
        <tbody class="bg-white">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td class="fw-bold text-muted">#<?= htmlspecialchars($book['id']) ?></td>
                    <td class="fw-medium text-dark"><?= htmlspecialchars($book['title']) ?></td>
                    <td><span class="badge"
                              style="background-color: #8a8d91;"><?= htmlspecialchars($book['type']) ?></span></td>
                    <td><?= htmlspecialchars($book['publisher']) ?></td>
                    <?php if (isset($_SESSION['username'])): ?>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="index.php?page=books_edit&id=<?= $book['id'] ?>" class="btn btn-sm text-white"
                                   style="background-color: #c5a059;">Edit</a>
                                <form method="post" action="index.php?page=books_delete"
                                      onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    <input type="hidden" name="id" value="<?= $book['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center py-4 text-muted">No books found in the catalog.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

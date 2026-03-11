<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="mb-0 text-secondary" style="font-family: Georgia, serif;">Supplier Directory</h2>

        <?php if (isset($_GET['error']) && $_GET['error'] === 'in_use'): ?>
            <div class="alert alert-danger shadow-lg border-0 alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4" style="z-index: 1050; width: max-content; max-width: 90vw;" role="alert">
                <strong>⚠️ Action Denied:</strong> Cannot delete this supplier because they are linked to existing books in the catalog.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <a href="index.php?page=suppliers_create" class="btn shadow-sm px-4" style="background-color: #c5a059; color: #fff; border: none; font-weight: 500;">
            + Add New Supplier
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover mb-0 align-middle border-light">
            <thead class="table-secondary text-secondary">
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Supplied Books</th> <th>Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            <?php if (!empty($suppliers)): ?>
                <?php $row_count = 1; ?>
                <?php foreach ($suppliers as $supplier): ?>
                    <tr>
                        <td class="fw-bold text-muted"><?= $row_count++ ?></td>
                        <td class="fw-medium text-dark"><?= htmlspecialchars($supplier['name']) ?></td>
                        <td><?= htmlspecialchars($supplier['email'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($supplier['phone'] ?? 'N/A') ?></td>

                        <td>
                            <?php if (!empty($supplier['supplied_books'])): ?>
                                <span class="text-muted" style="font-size: 0.9em;">
                                    <?= htmlspecialchars($supplier['supplied_books']) ?>
                                </span>
                            <?php else: ?>
                                <span class="text-black-50 fst-italic" style="font-size: 0.9em;">None</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="index.php?page=suppliers_edit&id=<?= $supplier['id'] ?>" class="btn btn-sm text-white" style="background-color: #c5a059;">Edit</a>
                                <form method="post" action="index.php?page=suppliers_delete" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                                    <input type="hidden" name="id" value="<?= $supplier['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center py-4 text-muted">No suppliers registered.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
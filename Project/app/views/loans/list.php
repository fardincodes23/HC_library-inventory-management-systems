<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="mb-0 text-secondary" style="font-family: Georgia, serif;">Loan Registry</h2>

        <a href="index.php?page=loan_checkout" class="btn shadow-sm px-4"
           style="background-color: #c5a059; color: #fff; border: none; font-weight: 500;">
            + Checkout Book
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover mb-0 align-middle border-light">
            <thead class="table-secondary text-secondary">
            <tr>
                <th>ID</th>
                <th>Book</th>
                <th>Client</th>
                <th>Loan Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            <?php if (!empty($loans)): ?>
                <?php foreach ($loans as $loan): ?>
                    <tr>
                        <td class="text-muted">#<?= htmlspecialchars($loan['id']) ?></td>
                        <td class="fw-medium"><?= htmlspecialchars($loan['book_title'] ?? 'Unknown Book') ?></td>
                        <td><?= htmlspecialchars($loan['client_name'] ?? 'Unknown Client') ?></td>
                        <td><?= htmlspecialchars($loan['loan_date']) ?></td>
                        <td><?= htmlspecialchars($loan['due_date']) ?></td>
                        <td>
                            <?php if (!empty($loan['return_date'])): ?>
                                <span class="badge bg-secondary bg-opacity-75">Returned on <?= htmlspecialchars($loan['return_date']) ?></span>
                            <?php else: ?>
                                <span class="badge" style="background-color: #c5a059;">Active</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (empty($loan['return_date'])): ?>
                                <a href="index.php?page=loan_return&id=<?= $loan['id'] ?>"
                                   class="btn btn-sm btn-outline-secondary rounded-pill px-3">Mark Returned</a>
                            <?php else: ?>
                                <span class="text-muted fst-italic">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No loan records found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
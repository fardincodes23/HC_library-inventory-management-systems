<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="mb-0 text-danger" style="font-family: Georgia, serif;">⚠️ Overdue Books Report</h2>
        <a href="index.php?page=loans" class="btn btn-outline-secondary px-4 shadow-sm">Back to All Loans</a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover mb-0 align-middle border-light">
            <thead class="text-white" style="background-color: #8a8d91;">
            <tr>
                <th>Loan ID</th>
                <th>Client Name</th>
                <th>Contact Info</th>
                <th>Book Title</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            <?php if (!empty($overdueLoans)): ?>
                <?php foreach ($overdueLoans as $loan): ?>
                    <tr>
                        <td class="fw-bold text-muted">#<?= htmlspecialchars($loan['id']) ?></td>
                        <td class="fw-medium text-dark"><?= htmlspecialchars($loan['client_name']) ?></td>
                        <td style="font-size: 0.9em;">
                            <?= htmlspecialchars($loan['email'] ?? 'No email') ?><br>
                            <?= htmlspecialchars($loan['phone'] ?? 'No phone') ?>
                        </td>
                        <td class="fst-italic"><?= htmlspecialchars($loan['book_title']) ?></td>
                        <td class="text-danger fw-bold"><?= htmlspecialchars($loan['due_date']) ?></td>
                        <td>
                            <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">
                                <?= htmlspecialchars($loan['days_overdue']) ?> Days Late
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center py-5 text-success fw-bold">
                        🎉 Great news! There are no overdue books at this time.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
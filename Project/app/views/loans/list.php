<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Loans</h2>
<p>
    <a href="index.php?page=loan_checkout">Check Out Book</a> |
    <a href="index.php?page=loan_return">Return Book</a>
</p>

<table class="table table-striped table-hover table-bordered shadow-sm bg-white">
    <tr>
        <th>ID</th><th>Book</th><th>Client</th><th>Loan Date</th><th>Due Date</th><th>Return Date</th>
    </tr>
    <?php foreach ($loans as $loan): ?>
        <tr>
            <td><?= htmlspecialchars($loan['id']) ?></td>
            <td><?= htmlspecialchars($loan['book_title']) ?></td>
            <td><?= htmlspecialchars($loan['client_name']) ?></td>
            <td><?= htmlspecialchars($loan['loan_date']) ?></td>
            <td><?= htmlspecialchars($loan['due_date']) ?></td>
            <td><?= htmlspecialchars($loan['return_date'] ?? '') ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../layout/footer.php'; ?>

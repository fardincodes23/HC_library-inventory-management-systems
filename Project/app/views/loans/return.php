<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Return Book</h2>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="index.php?page=loan_return">
    <label>Active Loan:
        <select name="loan_id" required>
            <option value="">-- Select Loan --</option>
            <?php foreach ($activeLoans as $loan): ?>
                <option value="<?= $loan['id']; ?>">
                    #<?= $loan['id']; ?> - <?= htmlspecialchars($loan['book_title']); ?> (<?= htmlspecialchars($loan['client_name']); ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>
    <label>Return Date:
        <input type="date" name="return_date" value="<?= date('Y-m-d'); ?>" required>
    </label><br><br>
    <button type="submit">Record Return</button>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>

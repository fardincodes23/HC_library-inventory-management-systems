<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Check Out Book</h2>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="index.php?page=loan_checkout">
    <label>Book:
        <select name="book_id" required>
            <option value="">-- Select Book --</option>
            <?php foreach ($books as $book): ?>
                <option value="<?= $book['id']; ?>"><?= htmlspecialchars($book['title']); ?></option>
            <?php endforeach; ?>
        </select>
    </label><br><br>
    <label>Client:
        <select name="client_id" required>
            <option value="">-- Select Client --</option>
            <?php foreach ($clients as $client): ?>
                <option value="<?= $client['id']; ?>"><?= htmlspecialchars($client['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </label><br><br>
    <label>Loan Date:
        <input type="date" name="loan_date" value="<?= date('Y-m-d'); ?>" required>
    </label><br><br>
    <label>Due Date:
        <input type="date" name="due_date" value="<?= date('Y-m-d', strtotime('+14 days')); ?>" required>
    </label><br><br>
    <button type="submit">Create Loan</button>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>

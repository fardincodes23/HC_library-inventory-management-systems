<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm border-0">
                <div class="card-header text-white py-3" style="background-color: #8a8d91;">
                    <h4 class="mb-0" style="font-family: Georgia, serif;">Checkout a Book</h4>
                </div>

                <div class="card-body p-4 bg-white rounded-bottom">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger shadow-sm"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="post" action="index.php?page=loan_checkout">
                        <div class="mb-3">
                            <label for="book_id" class="form-label fw-bold text-secondary">Select Book</label>
                            <select name="book_id" id="book_id" class="form-select bg-light border-0 shadow-sm"
                                    required>
                                <option value="">-- Choose a Book --</option>
                                <?php foreach ($books as $book): ?>
                                    <option value="<?= htmlspecialchars($book['id']) ?>">
                                        <?= htmlspecialchars($book['title']) ?>
                                        (ID: <?= htmlspecialchars($book['id']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="client_id" class="form-label fw-bold text-secondary">Select Client</label>
                            <select name="client_id" id="client_id" class="form-select bg-light border-0 shadow-sm"
                                    required>
                                <option value="">-- Choose a Client --</option>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?= htmlspecialchars($client['id']) ?>">
                                        <?= htmlspecialchars($client['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="due_date" class="form-label fw-bold text-secondary">Due Date</label>
                            <input type="date" name="due_date" id="due_date"
                                   class="form-control bg-light border-0 shadow-sm" required>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="index.php?page=loans" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn px-4 shadow-sm"
                                    style="background-color: #c5a059; color: #fff; border: none;">Confirm Checkout
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
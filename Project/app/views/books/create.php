<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow border-0">
                <div class="card-header text-white py-3" style="background-color: #8a8d91;">
                    <h4 class="mb-0" style="font-family: Georgia, serif;">Add New Book</h4>
                </div>
                <div class="card-body p-4 bg-white rounded-bottom">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger shadow-sm"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="post" action="index.php?page=books_create">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Book Title</label>
                            <input type="text" name="title" class="form-control bg-light border-0 shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Type (Genre)</label>
                            <input type="text" name="type" class="form-control bg-light border-0 shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Publisher</label>
                            <input type="text" name="publisher" class="form-control bg-light border-0 shadow-sm"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="supplier_id" class="form-label fw-bold text-secondary">Supplier Details</label>
                            <select name="supplier_id" id="supplier_id" class="form-select bg-light border-0 shadow-sm">
                                <option value="">-- Independent / No Supplier --</option>
                                <?php if (!empty($suppliers)): ?>
                                    <?php foreach ($suppliers as $supplier): ?>
                                        <option value="<?= htmlspecialchars($supplier['id']) ?>">
                                            <?= htmlspecialchars($supplier['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="index.php?page=books" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn px-4 shadow-sm"
                                    style="background-color: #c5a059; color: #fff; border: none;">Save Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
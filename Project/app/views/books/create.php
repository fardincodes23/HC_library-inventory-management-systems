<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0">Add New Book</h4>
                </div>

                <div class="card-body p-4 bg-white">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="post" action="index.php?page=books_create">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="e.g. The Pragmatic Programmer" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label fw-bold">Type (Genre)</label>
                            <input type="text" name="type" id="type" class="form-control" placeholder="e.g. Programming" required>
                        </div>

                        <div class="mb-4">
                            <label for="publisher" class="form-label fw-bold">Publisher</label>
                            <input type="text" name="publisher" id="publisher" class="form-control" placeholder="e.g. Addison-Wesley" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php?page=books" class="btn btn-light border">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Save Book</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
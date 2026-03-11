<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6">

            <div class="card shadow-sm border-0 text-center">
                <div class="card-body p-5 bg-white rounded">
                    <h3 class="text-secondary mb-3" style="font-family: Georgia, serif;">Process Return</h3>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger shadow-sm"><?= htmlspecialchars($error) ?></div>
                        <a href="index.php?page=loans" class="btn btn-outline-secondary mt-3">Back to Loans</a>
                    <?php else: ?>
                        <p class="lead text-muted mb-4">Are you sure you want to mark this loan as returned today?</p>

                        <form method="post" action="index.php?page=loan_return">
                            <input type="hidden" name="loan_id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">
                            <input type="hidden" name="return_date" value="<?= date('Y-m-d') ?>">

                            <div class="d-flex justify-content-center gap-3">
                                <a href="index.php?page=loans" class="btn btn-outline-secondary px-4">Cancel</a>
                                <button type="submit" class="btn px-4 shadow-sm"
                                        style="background-color: #c5a059; color: #fff; border: none;">Yes, Mark Returned
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
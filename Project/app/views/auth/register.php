<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-5">

            <div class="card shadow-sm border-0">
                <div class="card-header text-white py-3" style="background-color: #8a8d91;">
                    <h4 class="mb-0" style="font-family: Georgia, serif;">Register New Staff</h4>
                </div>

                <div class="card-body p-4 bg-white rounded-bottom">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger shadow-sm"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success shadow-sm"><?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>

                    <form method="post" action="index.php?page=register">
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold text-secondary">Username</label>
                            <input type="text" name="username" id="username"
                                   class="form-control bg-light border-0 shadow-sm" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold text-secondary">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control bg-light border-0 shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-bold text-secondary">Confirm
                                Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                   class="form-control bg-light border-0 shadow-sm" required>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="index.php" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn px-4 shadow-sm"
                                    style="background-color: #c5a059; color: #fff; border: none;">Register Staff
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-4">

            <div class="card shadow border-0">
                <div class="card-header text-white py-3 text-center" style="background-color: #8a8d91;">
                    <h4 class="mb-0" style="font-family: Georgia, serif;">Staff Portal Access</h4>
                </div>

                <div class="card-body p-4 bg-white rounded-bottom">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger shadow-sm text-center"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="post" action="index.php?page=login">
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold text-secondary">Username</label>
                            <input type="text" name="username" id="username"
                                   class="form-control bg-light border-0 shadow-sm" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-secondary">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control bg-light border-0 shadow-sm" required>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn shadow-sm fw-bold py-2"
                                    style="background-color: #c5a059; color: #fff; border: none; font-size: 1.1rem; font-family: Georgia, serif;">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
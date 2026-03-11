<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm border-0">
                <div class="card-header text-white py-3" style="background-color: #8a8d91;">
                    <h4 class="mb-0" style="font-family: Georgia, serif;">Register New Client</h4>
                </div>

                <div class="card-body p-4 bg-white rounded-bottom">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger shadow-sm"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="post" action="index.php?page=clients_create">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold text-secondary">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control bg-light border-0 shadow-sm"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold text-secondary">Email Address</label>
                            <input type="email" name="email" id="email"
                                   class="form-control bg-light border-0 shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label fw-bold text-secondary">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control bg-light border-0 shadow-sm">
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="index.php?page=clients" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn px-4 shadow-sm"
                                    style="background-color: #c5a059; color: #fff; border: none;">Save Client
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
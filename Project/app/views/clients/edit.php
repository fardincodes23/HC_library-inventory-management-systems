<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow border-0">
                <div class="card-header text-white py-3" style="background-color: #8a8d91;">
                    <h4 class="mb-0" style="font-family: Georgia, serif;">Edit Client Profile</h4>
                </div>
                <div class="card-body p-4 bg-white rounded-bottom">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger shadow-sm"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="post" action="index.php?page=clients_edit&id=<?= $client['id'] ?>">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Full Name</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($client['name']) ?>" class="form-control bg-light border-0 shadow-sm" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Email Address</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" class="form-control bg-light border-0 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Phone Number</label>
                            <input type="text" name="phone" value="<?= htmlspecialchars($client['phone']) ?>" class="form-control bg-light border-0 shadow-sm">
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="index.php?page=clients" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn px-4 shadow-sm" style="background-color: #c5a059; color: #fff; border: none;">Update Client</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
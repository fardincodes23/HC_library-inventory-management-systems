<?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="mb-0 text-secondary" style="font-family: Georgia, serif;">Client Directory</h2>

        <?php if (isset($_SESSION['username'])): ?>
            <a href="index.php?page=clients_create" class="btn shadow-sm px-4" style="background-color: #c5a059; color: #fff; border: none; font-weight: 500;">
                + Add New Client
            </a>
        <?php endif; ?>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover mb-0 align-middle border-light">
            <thead class="table-secondary text-secondary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            <?php if (!empty($clients)): ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td class="fw-bold text-muted">#<?= htmlspecialchars($client['id']) ?></td>
                        <td class="fw-medium text-dark"><?= htmlspecialchars($client['name']) ?></td>
                        <td><?= htmlspecialchars($client['email']) ?></td>
                        <td><?= htmlspecialchars($client['phone']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center py-4 text-muted">No clients currently registered.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
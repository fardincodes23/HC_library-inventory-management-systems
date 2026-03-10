<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Clients</h2>
<p><a href="index.php?page=clients_create">Add Client</a></p>

<table>
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
    </tr>
    <?php foreach ($clients as $client): ?>
        <tr>
            <td><?= htmlspecialchars($client['id']) ?></td>
            <td><?= htmlspecialchars($client['name']) ?></td>
            <td><?= htmlspecialchars($client['email']) ?></td>
            <td><?= htmlspecialchars($client['phone']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../layout/footer.php'; ?>

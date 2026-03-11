<?php include __DIR__ . '/layout/header.php'; ?>

    <div style="text-align: center; padding: 40px 20px;">
        <h1>Welcome to Library Inc.</h1>
        <p>Explore our vast collection of books and resources.</p>

        <div style="margin-top: 30px;">
            <img src="https://via.placeholder.com/600x300?text=Your+Library+Image+Here" alt="Library Image" style="max-width: 100%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        </div>

        <?php if (!isset($_SESSION['username'])): ?>
            <p style="margin-top: 20px;">
                <a href="index.php?page=books" style="padding: 10px 20px; background: #333; color: white; text-decoration: none; border-radius: 4px;">Browse Catalog</a>
            </p>
        <?php endif; ?>
    </div>

<?php include __DIR__ . '/layout/footer.php'; ?>
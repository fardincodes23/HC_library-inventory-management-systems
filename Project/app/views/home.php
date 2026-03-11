<?php include __DIR__ . '/layout/header.php'; ?>

    </main>

    <div class="hero-section text-center">
        <div class="container px-4">
            <h1 class="display-3 fw-bold mb-4 text-white text-shadow" style="font-family: Georgia, serif;">Welcome to Library Information Management Systems.</h1>
            <p class="lead mb-5 fs-4 text-white text-shadow">Explore our vast collection of books, manage your loans, and discover your next great read.</p>

            <?php if (!isset($_SESSION['username'])): ?>
                <a href="index.php?page=books" class="btn btn-lg px-5 py-3 fw-bold shadow-lg" style="background-color: #c5a059; color: #fff; border: none; font-family: Georgia, serif;">Browse the Catalog</a>
            <?php endif; ?>
        </div>
    </div>

    <style>
        main.my-5 { display: none !important; }

        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?= BASE_URL ?>app/resources/images/library.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .text-shadow { text-shadow: 2px 2px 8px rgba(0,0,0,0.8); }
    </style>

    <main class="d-none">

<?php include __DIR__ . '/layout/footer.php'; ?>
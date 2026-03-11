<?php include __DIR__ . '/layout/header.php'; ?>

    </main>

    <div class="hero-section text-center">
        <div class="container px-4">
            <h1 class="display-3 fw-bold mb-4 text-white text-shadow">Welcome to Library Inc.</h1>
            <p class="lead mb-5 fs-4 text-white text-shadow">Explore our vast collection of books, manage your loans, and discover your next great read.</p>

            <?php if (!isset($_SESSION['username'])): ?>
                <a href="index.php?page=books" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow">Browse the Catalog</a>
            <?php endif; ?>
        </div>
    </div>

    <style>
        /* 🌟 NEW: This hides the empty margin box created by the header! */
        main.my-5 {
            display: none !important;
        }

        .hero-section {
            /* The linear-gradient adds a dark tint over your image so the white text pops! */
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?= BASE_URL ?>app/resources/images/library.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            /* Flexbox makes it take up all the remaining space and centers the text perfectly */
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .text-shadow {
            text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
        }
    </style>

    <main class="d-none">

<?php include __DIR__ . '/layout/footer.php'; ?>
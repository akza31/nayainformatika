<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

$page = current_page();
$pageTitle = ROUTES[$page] . ' - ' . SITE_NAME;
$contentFile = __DIR__ . '/pages/' . $page . '.php';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body data-page="<?= e($page); ?>">
    <header class="site-header">
        <a class="brand" href="<?= e(route_url('home')); ?>" aria-label="Kembali ke beranda">
            <span class="brand-mark">NI</span>
            <span>
                <strong><?= e(SITE_NAME); ?></strong>
                <small>IT Partner</small>
            </span>
        </a>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-nav" id="main-menu" aria-label="Navigasi utama">
            <?php foreach (ROUTES as $route => $label): ?>
                <a class="<?= $page === $route ? 'active' : ''; ?>" href="<?= e(route_url($route)); ?>">
                    <?= e($label); ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </header>

    <main>
        <?php
        if (is_file($contentFile)) {
            require $contentFile;
        }
        ?>
    </main>

    <footer class="site-footer">
        <div>
            <strong><?= e(SITE_NAME); ?></strong>
            <p><?= e(SITE_TAGLINE); ?></p>
        </div>
        <div class="footer-links">
            <span>info@nayainformatika.co.id</span>
            <span>+62 812 3456 7890</span>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>

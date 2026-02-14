<?php
    // Generate full URL (for SEO & OpenGraph)
    $baseUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    $currentUrl = $baseUrl . $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="fr" prefix="og: https://ogp.me/ns#">

<head>

    <!-- Charset (First for performance) -->
    <meta charset="UTF-8">

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- DNS & Connection Optimization -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Title -->
    <title><?= htmlspecialchars($title ?? 'Your App Name', ENT_QUOTES); ?></title>

    <!-- SEO -->
    <meta name="description" content="<?= htmlspecialchars($description ?? 'High performance web application', ENT_QUOTES); ?>">
    <link rel="canonical" href="<?= $currentUrl; ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($title ?? 'Your App Name'); ?>">
    <meta property="og:description" content="<?= htmlspecialchars($description ?? 'High performance web application'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $currentUrl; ?>">

    <!-- Preload Critical CSS -->
    <!-- <link rel="preload" href="<?= PUBLIC_URL ?>assets/css/main.min.css" as="style"> -->

    <!-- Main CSS -->
    <!-- <link rel="stylesheet" href="<?= PUBLIC_URL ?>assets/css/main.min.css"> -->

    <!-- Main css tailwind -->
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>assets/css/main.css">

    <!-- Page CSS (Lazy) -->
    <?php if (!empty($css) && is_array($css)): ?>
        <?php foreach ($css as $file): ?>
            <link rel="preload"
                href="<?= PUBLIC_URL ?>assets/css/<?= htmlspecialchars($file); ?>"
                as="style"
                onload="this.rel='stylesheet'">
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Fallback for no-JS -->
    <noscript>
        <!-- <link rel="stylesheet" href="<?= PUBLIC_URL ?>/assets/css/main.css"> -->
        <link rel="stylesheet" href="<?= PUBLIC_URL ?>assets/css/main.css">
    </noscript>

</head>


<body>

    <!-- Skip Link (Accessibility + SEO) -->
    <!-- <a 
        href="#main-content" class="skip-link"
        class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:bg-white focus:text-black focus:px-4 focus:py-2 focus:rounded focus:shadow">
        Skip to content
    </a> -->

    <header>
        <?php include INCLUDES_PATH . '/nav.php'; ?>
    </header>

    <main id="main-content">
        <?= $content ?? '' ?>
    </main>

    <footer>
        <?php include INCLUDES_PATH . '/footer.php'; ?>
    </footer>

    <!-- Critical Inline Script -->
    <script>
        document.documentElement.classList.remove('no-js');
    </script>

    <!-- Main JS (Deferred) -->
    <script src="<?= PUBLIC_URL ?>assets/js/main.min.js" defer></script>

    <!-- Page JS -->
    <?php if (!empty($js) && is_array($js)): ?>
        <?php foreach ($js as $file): ?>
            <script src="<?= PUBLIC_URL ?>assets/js/<?= htmlspecialchars($file); ?>" defer></script>
        <?php endforeach; ?>
    <?php endif; ?>


    <!-- Lazy Load Images -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const imgs = document.querySelectorAll("img[data-src]");
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute("data-src");
                        observer.unobserve(img);
                    }
                });
            });

            imgs.forEach(img => observer.observe(img));
        });
    </script>

</body>
</html>

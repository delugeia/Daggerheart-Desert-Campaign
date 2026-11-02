<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page['title']) ?> · Daggerheart Desert Campaign</title>
<link rel="stylesheet" href="<?= e(site_url('/css/styles.css')) ?>">
<script src="<?= e(site_url('/js/site.js')) ?>" defer></script>
<script src="<?= e(site_url('/js/lightbox.js')) ?>" defer></script>
</head>
<body class="<?= e($page['class']) ?>">
<a class="skip-link" href="#content">Skip to content</a>
<header class="mobile-header">
<a class="mobile-brand" href="<?= e(site_url('/')) ?>">Desert Campaign</a>
<button class="menu-button" type="button" aria-controls="navigation" aria-expanded="false">Contents</button>
</header>
<div class="site-layout">
<?php require __DIR__ . '/navigation.php'; ?>
<div class="content-panel"><main class="page" id="content">
<?php if ($notFound): ?>
<h1>Page not found</h1><p>The requested page could not be found. <a href="<?= e(site_url('/')) ?>">Return to Home</a>.</p>
<?php else: render_content($contentFile); endif; ?>
</main></div>
</div>
</body>
</html>

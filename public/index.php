<?php

declare(strict_types=1);

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\MarkdownConverter;

require dirname(__DIR__) . '/vendor/autoload.php';

$root = dirname(__DIR__);
$documents = ['README' => $root . '/README.md'];

foreach (glob($root . '/encyclopedia/*.md') ?: [] as $file) {
    $documents[pathinfo($file, PATHINFO_FILENAME)] = $file;
}

$requested = isset($_GET['page']) && is_string($_GET['page']) ? $_GET['page'] : 'README';
$current = array_key_exists($requested, $documents) ? $requested : 'README';
$notFound = $requested !== $current;

function documentTitle(string $file): string
{
    $markdown = file_get_contents($file) ?: '';
    if (preg_match('/^#\s+(.+)$/m', $markdown, $matches) === 1) {
        return trim($matches[1]);
    }

    return pathinfo($file, PATHINFO_FILENAME);
}

function pageUrl(string $key): string
{
    return $key === 'README' ? '/' : '/?page=' . rawurlencode($key);
}

$titles = [];
foreach ($documents as $key => $file) {
    $titles[$key] = documentTitle($file);
}

$titles['README'] = 'Table of Contents';

uksort($titles, static function (string $a, string $b) use ($titles): int {
    $group = static function (string $key): int {
        if ($key === 'README') {
            return 0;
        }

        return str_starts_with(strtolower($key), 'appendix') ? 2 : 1;
    };

    $groupComparison = $group($a) <=> $group($b);
    return $groupComparison !== 0
        ? $groupComparison
        : strnatcasecmp($titles[$a], $titles[$b]);
});

$environment = new Environment([
    'html_input' => 'strip',
    'allow_unsafe_links' => false,
    'heading_permalink' => [
        'id_prefix' => '',
        'fragment_prefix' => '',
        'apply_id_to_heading' => true,
        'insert' => 'none',
    ],
    'table' => [
        'wrap' => [
            'enabled' => true,
            'tag' => 'div',
            'attributes' => ['class' => 'table-responsive'],
        ],
    ],
]);
$environment->addExtension(new CommonMarkCoreExtension());
$environment->addExtension(new GithubFlavoredMarkdownExtension());
$environment->addExtension(new HeadingPermalinkExtension());
$converter = new MarkdownConverter($environment);
$markdown = file_get_contents($documents[$current]) ?: '';
$content = (string) $converter->convert($markdown);

$content = preg_replace_callback(
    '/href="(?:\.\.\/)?(?:encyclopedia\/)?([^\/#?]+)\.md(#[^"]*)?"/i',
    static function (array $matches) use ($documents): string {
        $key = rawurldecode($matches[1]);
        if (!array_key_exists($key, $documents)) {
            return $matches[0];
        }

        return 'href="' . htmlspecialchars(pageUrl($key) . ($matches[2] ?? ''), ENT_QUOTES) . '"';
    },
    $content
) ?? $content;

$pageTitle = $titles[$current];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Campaign encyclopedia for the Daggerheart Desert Campaign.">
    <title><?= htmlspecialchars($pageTitle) ?> · Daggerheart Desert Campaign</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <header class="masthead">
        <a class="brand" href="/">
            <span class="brand-mark" aria-hidden="true">☀</span>
            <span>
                <strong>Daggerheart</strong>
                <small>Desert Campaign</small>
            </span>
        </a>
        <button class="menu-button" type="button" aria-controls="navigation" aria-expanded="false">Contents</button>
    </header>

    <div class="shell">
        <aside class="sidebar" id="navigation">
            <nav aria-label="Campaign encyclopedia">
                <p class="nav-label">Campaign Archive</p>
                <?php foreach ($titles as $key => $title): ?>
                    <a href="<?= htmlspecialchars(pageUrl($key)) ?>"<?= $key === $current ? ' aria-current="page"' : '' ?>>
                        <?= htmlspecialchars($title) ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </aside>

        <main class="content" id="content">
            <?php if ($notFound): ?>
                <div class="notice">That chronicle could not be found. The campaign overview is shown instead.</div>
            <?php endif; ?>
            <article class="prose"><?= $content ?></article>
        </main>
    </div>

    <script>
        const button = document.querySelector('.menu-button');
        const navigation = document.querySelector('#navigation');
        button.addEventListener('click', () => {
            const open = navigation.classList.toggle('is-open');
            button.setAttribute('aria-expanded', String(open));
        });
    </script>
</body>
</html>

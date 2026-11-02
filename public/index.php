<?php
declare(strict_types=1);
$pages = require dirname(__DIR__) . '/includes/navigation-config.php';
// Leave unset for a domain root; set CAMPAIGN_BASE_PATH=/campaign for a subdirectory.
$basePath = rtrim((string) (getenv('CAMPAIGN_BASE_PATH') ?: ''), '/');
function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function site_url(string $path): string { global $basePath; return $basePath . '/' . ltrim($path, '/'); }
function content_url(string $file): string {
    if ($file === 'home.html' || $file === 'index.html') return '/';
    if (str_ends_with($file, '/index.html')) return '/' . substr($file, 0, -11);
    return '/' . substr($file, 0, -5);
}
function redirect_page(string $path): never { header('Location: ' . site_url($path), true, 301); exit; }
function render_content(string $file): void {
    // Content uses site-root URLs. Prefix them for optional subdirectory hosting;
    // fragment-only links and external URLs stay unchanged.
    echo preg_replace_callback('~\b(href|src)="(/(?!/)[^"]*)"~',
        static fn(array $m): string => $m[1] . '="' . e(site_url(html_entity_decode($m[2], ENT_QUOTES, 'UTF-8'))) . '"',
        file_get_contents($file));
}
$path = rawurldecode((string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($basePath !== '' && ($path === $basePath || str_starts_with($path, $basePath . '/'))) {
    $path = substr($path, strlen($basePath)) ?: '/';
}
$path = rtrim($path, '/') ?: '/';
if ($path === '/home') redirect_page('/');
$contentRoot = realpath(dirname(__DIR__) . '/content');
$validPath = $path === '/' || preg_match('~^/[A-Za-z0-9_-]+(?:/[A-Za-z0-9_-]+)*$~D', $path);
$candidates = $path === '/'
    ? ['home.html', 'index.html']
    : [ltrim($path, '/') . '.html', ltrim($path, '/') . '/index.html'];
$relativeFile = '';
$contentFile = false;
if ($validPath) {
    // Prefer a matching page; otherwise use a directory's index.html.
    foreach ($candidates as $candidate) {
        $resolved = realpath($contentRoot . '/' . $candidate);
        if ($resolved && str_starts_with($resolved, $contentRoot . DIRECTORY_SEPARATOR) && is_file($resolved)) {
            $relativeFile = $candidate;
            $contentFile = $resolved;
            break;
        }
    }
}
$notFound = $contentFile === false;
if ($notFound) http_response_code(404);
else {
    $requestPath = (string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $canonicalPath = content_url($relativeFile);
    if ($requestPath !== site_url($canonicalPath)) redirect_page($canonicalPath);
}
// Navigation metadata is optional. Unlisted content derives its title from H1.
$page = ['title' => 'Page not found', 'class' => 'encyclopedia-page'];
if (!$notFound) {
    $markup = file_get_contents($contentFile);
    $title = preg_match('~<h1\b[^>]*>(.*?)</h1>~s', $markup, $heading)
        ? html_entity_decode(strip_tags($heading[1]), ENT_QUOTES, 'UTF-8')
        : ucwords(str_replace(['-', '_'], ' ', basename($path)));
    $page = ['title' => $title, 'class' => 'encyclopedia-page'];
    foreach ($pages as $entry) {
        if ($entry['file'] === $relativeFile) { $page = $entry; break; }
    }
}
require dirname(__DIR__) . '/includes/layout.php';

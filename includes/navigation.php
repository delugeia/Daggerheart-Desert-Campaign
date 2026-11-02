<aside class="sidebar" id="navigation">
<a class="brand" href="<?= e(site_url('/')) ?>">Desert Campaign</a>
<?php foreach (['Campaign', 'Appendices', 'Vampire houses', 'Galleries', 'Reference'] as $group): ?>
<p class="nav-heading"><?= e($group) ?></p>
<nav aria-label="<?= e($group) ?>">
<?php foreach ($pages as $key => $entry): if ($entry['group'] !== $group || !empty($entry['hidden'])) continue; ?>
<a class="nav-link" href="<?= e(site_url(content_url($entry['file']))) ?>"<?= $entry['file'] === $relativeFile ? ' aria-current="page"' : '' ?>><?= e($entry['label']) ?></a>
<?php endforeach; ?>
</nav>
<?php endforeach; ?>
</aside>

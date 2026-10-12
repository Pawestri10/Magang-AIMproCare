<?php
$pager = $pager ?? null;
$total = (int) ($total ?? 0);
$perPage = (int) ($perPage ?? 10);
$group = $group ?? 'default';

if ($pager === null || $total <= 0) {
    return;
}

$currentPage = $pager->getCurrentPage($group);
$totalPages = $pager->getPageCount($group);
$start = (($currentPage - 1) * $perPage) + 1;
$end = min($currentPage * $perPage, $total);
?>

<div class="app-pagination">
    <div class="app-pagination-info">
        Menampilkan
        <strong><?= $start ?> - <?= $end ?></strong>
        dari
        <strong><?= $total ?></strong>
        data
    </div>

    <?php if ($totalPages > 1): ?>
        <nav class="app-pagination-nav" aria-label="Navigasi halaman">
            <?php
            $links = $pager->links($group, 'default_full');
            ?>

            <?= $links ?>
        </nav>
    <?php endif; ?>
</div>
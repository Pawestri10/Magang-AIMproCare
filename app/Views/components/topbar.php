<?php
$currentPath = trim(uri_string(), '/');

$pageTitles = [
    'admin/dashboard' => 'Dashboard',
    'admin/products' => 'Produk',
    'admin/users' => 'Pengguna',
    'admin/customers' => 'Pembeli',
    'admin/sales' => 'Penjualan & Aktivasi Garansi',
    'admin/claims' => 'Klaim Garansi',
    'admin/reports' => 'Laporan',
    'admin/activity-log' => 'Activity Log',
    'admin/notification-settings' => 'Pengaturan',

    'qc/dashboard' => 'Dashboard QC',
    'qc/product-units' => 'Pemeriksaan QC',
];

$resolvedPageTitle = $pageTitle
    ?? $pageTitles[$currentPath]
    ?? 'AIMpro Care';
?>

<header class="app-topbar">

    <div class="topbar-page">
        <h1 class="topbar-title">
            <?= esc($resolvedPageTitle) ?>
        </h1>
    </div>

    <div class="topbar-user">

        <button
            type="button"
            class="topbar-profile-button"
            id="topbarProfileButton"
            aria-expanded="false"
            aria-controls="topbarProfileDropdown">
            <div class="topbar-user-info">
                <span class="topbar-user-name">
                    <?= esc(session()->get('name') ?? 'Pengguna') ?>
                </span>

                <span class="topbar-user-role">
                    <?= esc(session()->get('role') ?? '') ?>
                </span>
            </div>

            <svg
                class="topbar-profile-chevron"
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true">
                <path d="m6 9 6 6 6-6" />
            </svg>
        </button>

        <div
            class="topbar-profile-dropdown"
            id="topbarProfileDropdown"
            hidden>
            <div class="topbar-dropdown-user">
                <span class="topbar-user-name">
                    <?= esc(session()->get('name') ?? 'Pengguna') ?>
                </span>

                <span class="topbar-user-role">
                    <?= esc(session()->get('role') ?? '') ?>
                </span>
            </div>

            <div class="topbar-dropdown-divider"></div>

            <a
                href="<?= site_url('logout') ?>"
                class="topbar-logout-link">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <path d="m16 17 5-5-5-5" />
                    <path d="M21 12H9" />
                </svg>

                <span>Logout</span>
            </a>
        </div>

    </div>

</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileButton = document.getElementById('topbarProfileButton');
        const profileDropdown = document.getElementById('topbarProfileDropdown');

        if (!profileButton || !profileDropdown) {
            return;
        }

        profileButton.addEventListener('click', function(event) {
            event.stopPropagation();

            const isOpening = profileDropdown.hidden;

            profileDropdown.hidden = !isOpening;
            profileButton.setAttribute('aria-expanded', String(isOpening));
        });

        document.addEventListener('click', function(event) {
            if (
                !profileButton.contains(event.target) &&
                !profileDropdown.contains(event.target)
            ) {
                profileDropdown.hidden = true;
                profileButton.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                profileDropdown.hidden = true;
                profileButton.setAttribute('aria-expanded', 'false');
            }
        });
    });
</script>
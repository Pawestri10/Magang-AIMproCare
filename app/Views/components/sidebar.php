<?php
$currentPath = trim(uri_string(), '/');

$isActive = static function (string $path) use (&$currentPath): bool {
    return $currentPath === trim($path, '/');
};
?>

<aside class="app-sidebar">

    <div class="sidebar-brand">

        <a href="<?= session()->get('role') === 'Administrator'
                        ? site_url('admin/dashboard')
                        : site_url('qc/dashboard') ?>">

            <span class="sidebar-brand-name">
                AIMpro Care
            </span>

            <span class="sidebar-brand-subtitle">
                Warranty & After-Sales System
            </span>

        </a>

    </div>


    <nav class="sidebar-navigation">

        <?php if (session()->get('role') === 'Administrator'): ?>

            <div class="sidebar-section">

                <span class="sidebar-section-title">
                    ADMINISTRATOR
                </span>

                <ul class="sidebar-menu">

                    <li class="sidebar-menu-item">
                        <a
                            href="<?= site_url('admin/dashboard') ?>"
                            class="sidebar-menu-link <?= $isActive('admin/dashboard') ? 'active' : '' ?>">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true">

                                <rect x="3" y="3" width="7" height="7" rx="1" />
                                <rect x="14" y="3" width="7" height="7" rx="1" />
                                <rect x="14" y="14" width="7" height="7" rx="1" />
                                <rect x="3" y="14" width="7" height="7" rx="1" />

                            </svg>

                            <span class="sidebar-menu-label">
                                Dashboard
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">

                        <span class="sidebar-menu-label">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true">
                                <ellipse cx="12" cy="5" rx="9" ry="3" />
                                <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5" />
                                <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3" />
                            </svg>
                            Master Data
                        </span>

                        <ul class="sidebar-submenu">

                            <li class="sidebar-submenu-item">
                                <a
                                    href="<?= site_url('admin/products') ?>"
                                    class="sidebar-menu-link <?= $isActive('admin/products') ? 'active' : '' ?>">

                                    <span class="sidebar-menu-label">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            aria-hidden="true">
                                            <path d="m12 3 9 5-9 5-9-5 9-5Z" />
                                            <path d="m3 8 9 5 9-5" />
                                            <path d="M3 8v8l9 5 9-5V8" />
                                            <path d="M12 13v8" />
                                        </svg>
                                        Produk
                                    </span>

                                </a>
                            </li>

                            <li class="sidebar-submenu-item">
                                <a
                                    href="<?= site_url('admin/customers') ?>"
                                    class="sidebar-menu-link <?= $isActive('admin/customers') ? 'active' : '' ?>">

                                    <span class="sidebar-menu-label">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            aria-hidden="true">
                                            <circle cx="12" cy="8" r="5" />
                                            <path d="M20 21a8 8 0 0 0-16 0" />
                                        </svg>
                                        Pembeli
                                    </span>

                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="<?= site_url('admin/sales') ?>"
                            class="sidebar-menu-link <?= $isActive('admin/sales') ? 'active' : '' ?>">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="9" cy="21" r="1" />
                                <circle cx="20" cy="21" r="1" />
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                            </svg>

                            <span class="sidebar-menu-label">
                                Penjualan & Aktivasi Garansi
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="<?= site_url('admin/claims') ?>"
                            class="sidebar-menu-link <?= $isActive('admin/claims') ? 'active' : '' ?>">

                            <span class="sidebar-menu-label">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true">
                                    <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                Klaim Garansi
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="<?= site_url('admin/reports') ?>"
                            class="sidebar-menu-link <?= $isActive('admin/reports') ? 'active' : '' ?>">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 3v18h18" />
                                <path d="M18 17V9" />
                                <path d="M13 17V5" />
                                <path d="M8 17v-3" />
                            </svg>

                            <span class="sidebar-menu-label">
                                Laporan
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="<?= site_url('admin/activity-log') ?>"
                            class="sidebar-menu-link <?= $isActive('admin/activity-log') ? 'active' : '' ?>">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 12a9 9 0 1 0 3-6.7L3 8" />
                                <path d="M3 3v5h5" />
                                <path d="M12 7v5l3 2" />
                            </svg>

                            <span class="sidebar-menu-label">
                                Activity Log
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="<?= site_url('admin/notification-settings') ?>"
                            class="sidebar-menu-link <?= $isActive('admin/notification-settings') ? 'active' : '' ?>">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="3" />
                                <path d="m19.4 15 .1.1 1.4 1.1-1.4 2.4-1.7-.6a8 8 0 0 1-1.5.9l-.3 1.8h-2.8l-.3-1.8a8 8 0 0 1-1.5-.9l-1.7.6-1.4-2.4 1.4-1.1a8 8 0 0 1 0-1.8l-1.4-1.1 1.4-2.4 1.7.6a8 8 0 0 1 1.5-.9l.3-1.8h2.8l.3 1.8a8 8 0 0 1 1.5.9l1.7-.6 1.4 2.4-1.4 1.1a8 8 0 0 1 0 1.7Z" transform="translate(-1 -1) scale(1.08)" />
                            </svg>

                            <span class="sidebar-menu-label">
                                Pengaturan
                            </span>

                        </a>
                    </li>

                </ul>

            </div>

        <?php elseif (session()->get('role') === 'Petugas QC'): ?>

            <div class="sidebar-section">

                <span class="sidebar-section-title">
                    PETUGAS QC
                </span>

                <ul class="sidebar-menu">

                    <li class="sidebar-menu-item">
                        <a
                            href="<?= site_url('qc/dashboard') ?>"
                            class="sidebar-menu-link <?= $isActive('qc/dashboard') ? 'active' : '' ?>">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="3" width="7" height="7" rx="1" />
                                <rect x="14" y="3" width="7" height="7" rx="1" />
                                <rect x="14" y="14" width="7" height="7" rx="1" />
                                <rect x="3" y="14" width="7" height="7" rx="1" />
                            </svg>

                            <span class="sidebar-menu-label">
                                Dashboard
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="<?= site_url('qc/product-units') ?>"
                            class="sidebar-menu-link <?= $isActive('qc/product-units') ? 'active' : '' ?>">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="4" y="3" width="16" height="18" rx="2" />
                                <path d="M9 3.5h6" />
                                <path d="m8 12 2 2 5-5" />
                                <path d="M8 17h8" />
                            </svg>

                            <span class="sidebar-menu-label">
                                Pemeriksaan QC
                            </span>

                        </a>
                    </li>

                </ul>

            </div>

        <?php endif; ?>

    </nav>

</aside>
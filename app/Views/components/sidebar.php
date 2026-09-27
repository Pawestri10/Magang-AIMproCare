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
                            class="sidebar-menu-link">

                            <span class="sidebar-menu-label">
                                Dashboard
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">

                        <span class="sidebar-menu-label">
                            Master Data
                        </span>

                        <ul class="sidebar-submenu">

                            <li class="sidebar-submenu-item">
                                <a
                                    href="<?= site_url('admin/products') ?>"
                                    class="sidebar-menu-link">

                                    <span class="sidebar-menu-label">
                                        Produk
                                    </span>

                                </a>
                            </li>

                            <li class="sidebar-submenu-item">
                                <a
                                    href="#"
                                    class="sidebar-menu-link">

                                    <span class="sidebar-menu-label">
                                        Pengguna
                                    </span>

                                </a>
                            </li>

                            <li class="sidebar-submenu-item">
                                <a
                                    href="#"
                                    class="sidebar-menu-link">

                                    <span class="sidebar-menu-label">
                                        Pembeli
                                    </span>

                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="#"
                            class="sidebar-menu-link">

                            <span class="sidebar-menu-label">
                                Penjualan & Aktivasi Garansi
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="#"
                            class="sidebar-menu-link">

                            <span class="sidebar-menu-label">
                                Klaim Garansi
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="#"
                            class="sidebar-menu-link">

                            <span class="sidebar-menu-label">
                                Laporan
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="#"
                            class="sidebar-menu-link">

                            <span class="sidebar-menu-label">
                                Activity Log
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="#"
                            class="sidebar-menu-link">

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
                            class="sidebar-menu-link">

                            <span class="sidebar-menu-label">
                                Dashboard
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="<?= site_url('qc/product-units') ?>"
                            class="sidebar-menu-link">

                            <span class="sidebar-menu-label">
                                Pemeriksaan QC
                            </span>

                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a
                            href="#"
                            class="sidebar-menu-link">

                            <span class="sidebar-menu-label">
                                Riwayat Pemeriksaan
                            </span>

                        </a>
                    </li>

                </ul>

            </div>

        <?php endif; ?>

    </nav>


    <div class="sidebar-user">

        <div class="sidebar-user-info">

            <span class="sidebar-user-name">
                <?= esc(session()->get('name')) ?>
            </span>

            <span class="sidebar-user-role">
                <?= esc(session()->get('role')) ?>
            </span>

        </div>

        <a
            href="<?= site_url('logout') ?>"
            class="sidebar-logout">

            Logout

        </a>

    </div>

</aside>
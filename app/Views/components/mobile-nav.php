<nav class="mobile-nav">

    <?php if (session()->get('role') === 'Administrator'): ?>

        <a
            href="<?= site_url('admin/dashboard') ?>"
            class="mobile-nav-item">

            <span class="mobile-nav-label">
                Dashboard
            </span>

        </a>

        <a
            href="<?= site_url('admin/products') ?>"
            class="mobile-nav-item">

            <span class="mobile-nav-label">
                Produk
            </span>

        </a>

        <a
            href="#"
            class="mobile-nav-item">

            <span class="mobile-nav-label">
                Klaim
            </span>

        </a>

        <a
            href="<?= site_url('logout') ?>"
            class="mobile-nav-item">

            <span class="mobile-nav-label">
                Logout
            </span>

        </a>

    <?php elseif (session()->get('role') === 'Petugas QC'): ?>

        <a
            href="<?= site_url('qc/dashboard') ?>"
            class="mobile-nav-item">

            <span class="mobile-nav-label">
                Dashboard
            </span>

        </a>

        <a
            href="<?= site_url('qc/product-units') ?>"
            class="mobile-nav-item">

            <span class="mobile-nav-label">
                Pemeriksaan QC
            </span>

        </a>

        <a
            href="#"
            class="mobile-nav-item">

            <span class="mobile-nav-label">
                Riwayat
            </span>

        </a>

        <a
            href="<?= site_url('logout') ?>"
            class="mobile-nav-item">

            <span class="mobile-nav-label">
                Logout
            </span>

        </a>

    <?php endif; ?>

</nav>
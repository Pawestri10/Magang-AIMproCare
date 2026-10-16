<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header sales-page-header">

    <div>

        <h1>
            Penjualan & Aktivasi Garansi
        </h1>

        <p>
            Kelola unit siap dijual dan lihat riwayat penjualan serta aktivasi garansi.
        </p>

    </div>

</div>

<div class="card sales-unit-card">

    <div class="section-header">

        <div>

            <h2>
                Unit Siap Dijual
            </h2>

            <p>
                Unit yang telah lolos QC dan belum memiliki transaksi penjualan.
            </p>

        </div>

    </div>

    <form action="<?= site_url('admin/sales') ?>" method="get"
        class="search-filter-panel report-search-panel activity-log-search-panel">

        <div class="search-filter-fields report-filter-grid">

            <div class="form-group">
                <label for="unit_search">Cari Unit</label>

                <div class="search-input-wrapper">
                    <svg
                        class="search-input-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        width="19"
                        height="19"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-4-4" />
                    </svg>

                    <input
                        type="search"
                        id="unit_search"
                        name="unit_search"
                        class="form-control search-input"
                        value="<?= esc($unitSearch ?? '') ?>"
                        placeholder="Nama produk, brand, model, atau serial">
                </div>
            </div>

            <div class="form-group">
                <label for="unit_brand">Brand</label>

                <select id="unit_brand" name="unit_brand" class="form-control">
                    <option value="">Semua Brand</option>

                    <?php foreach ($unitBrands as $item): ?>
                        <option
                            value="<?= esc($item['brand']) ?>"
                            <?= ($unitBrand ?? '') === $item['brand'] ? 'selected' : '' ?>>
                            <?= esc($item['brand']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="unit_model">Model</label>

                <select id="unit_model" name="unit_model" class="form-control">
                    <option value="">Semua Model</option>

                    <?php foreach ($unitModels as $item): ?>
                        <option
                            value="<?= esc($item['model']) ?>"
                            <?= ($unitModel ?? '') === $item['model'] ? 'selected' : '' ?>>
                            <?= esc($item['model']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>

        <div class="search-filter-actions report-filter-actions">

            <button type="submit" class="button button-primary search-submit-button">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="17"
                    height="17"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m20 20-4-4" />
                </svg>
                <span>Cari</span>
            </button>

            <a href="<?= site_url('admin/sales') ?>" class="btn search-reset-button">
                Reset
            </a>

        </div>

    </form>

    <div class="activity-log-card">

        <?php if (empty($units)): ?>

            <div class="empty-state">

                <p>
                    Belum ada unit yang siap dijual.
                </p>

            </div>

        <?php else: ?>

            <div class="activity-log-table-wrapper">

                <table class="data-table">

                    <thead>

                        <tr>

                            <th>
                                No.
                            </th>

                            <th>
                                Produk
                            </th>

                            <th>
                                Brand
                            </th>

                            <th>
                                Model
                            </th>

                            <th>
                                Nomor Serial
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($units as $index => $unit): ?>

                            <tr>

                                <td>
                                    <?= ($unitsPager->getCurrentPage('units') - 1) * 10 + $index + 1 ?>
                                </td>

                                <td>
                                    <?= esc($unit['product_name']) ?>
                                </td>

                                <td>
                                    <?= esc($unit['brand']) ?>
                                </td>

                                <td>
                                    <?= esc($unit['model']) ?>
                                </td>

                                <td>
                                    <?= esc($unit['serial_number']) ?>
                                </td>

                                <td>

                                    <span class="badge badge-success">
                                        <?= esc($unit['status']) ?>
                                    </span>

                                </td>

                                <td>

                                    <div class="table-actions">

                                        <button
                                            type="button"
                                            class="button button-icon button-icon-view"
                                            data-tooltip="Pilih Unit"
                                            aria-label="Pilih Unit"
                                            data-modal-open="sales-select-modal-<?= esc($unit['id']) ?>">

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                aria-hidden="true">

                                                <rect
                                                    x="4"
                                                    y="4"
                                                    width="16"
                                                    height="16"
                                                    rx="3">
                                                </rect>

                                                <path d="m8 12 2.5 2.5L16 9"></path>

                                            </svg>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

        <?php if (!empty($units)): ?>
            <?= view('components/pagination', [
                'pager' => $unitsPager,
                'total' => $unitsPager->getDetails('units')['total'],
                'perPage' => 10,
                'group' => 'units',
            ]) ?>
        <?php endif; ?>

    </div>

</div>

<div class="card sales-history-card">

    <div class="section-header">

        <div>

            <h2>
                Riwayat Penjualan
            </h2>

            <p>
                Daftar transaksi penjualan dan aktivasi garansi yang telah dilakukan.
            </p>

        </div>

    </div>

    <form action="<?= site_url('admin/sales') ?>" method="get"
        class="search-filter-panel report-search-panel activity-log-search-panel">

        <div class="search-filter-fields report-filter-grid">

            <div class="form-group">
                <label for="sale_search">Cari Penjualan</label>

                <div class="search-input-wrapper">
                    <svg
                        class="search-input-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        width="19"
                        height="19"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-4-4" />
                    </svg>

                    <input
                        type="search"
                        id="sale_search"
                        name="sale_search"
                        class="form-control search-input"
                        value="<?= esc($saleSearch ?? '') ?>"
                        placeholder="Nama produk, serial, pembeli, atau nomor garansi">
                </div>
            </div>

            <div class="form-group">
                <label for="warranty_status">Status Garansi</label>

                <select id="warranty_status" name="warranty_status" class="form-control">
                    <option value="">Semua Status</option>

                    <?php foreach ($allowedWarrantyStatuses as $item): ?>
                        <option
                            value="<?= esc($item['status']) ?>"
                            <?= ($warrantyStatus ?? '') === $item['status'] ? 'selected' : '' ?>>
                            <?= esc($item['status']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Tanggal Pembelian Dari</label>

                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    class="form-control"
                    value="<?= esc($startDate ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="end_date">Tanggal Pembelian Sampai</label>

                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    class="form-control"
                    value="<?= esc($endDate ?? '') ?>">
            </div>

        </div>

        <div class="search-filter-actions report-filter-actions">

            <button type="submit" class="button button-primary search-submit-button">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="17"
                    height="17"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true">
                    <circle cx="11" cy="11" r="7" />
                    <path d="m20 20-4-4" />
                </svg>
                <span>Cari</span>
            </button>

            <a href="<?= site_url('admin/sales') ?>" class="btn search-reset-button">
                Reset
            </a>

        </div>

    </form>

    <div class="activity-log-card">

        <?php if (empty($sales)): ?>

            <div class="empty-state">

                <p>
                    Belum ada riwayat penjualan.
                </p>

            </div>

        <?php else: ?>

            <div class="activity-log-table-wrapper">

                <table class="data-table">

                    <thead>

                        <tr>

                            <th>
                                No.
                            </th>

                            <th>
                                Produk
                            </th>

                            <th>
                                Nomor Serial
                            </th>

                            <th>
                                Pembeli
                            </th>

                            <th>
                                Tanggal Pembelian
                            </th>

                            <th>
                                Nomor Garansi
                            </th>

                            <th>
                                Status Garansi
                            </th>

                            <th>
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($sales as $index => $sale): ?>

                            <tr>

                                <td>
                                    <?= ($salesPager->getCurrentPage('sales') - 1) * 10 + $index + 1 ?>
                                </td>

                                <td>

                                    <div>
                                        <?= esc($sale['product_name']) ?>
                                    </div>

                                    <small>
                                        <?= esc($sale['brand']) ?>
                                        —
                                        <?= esc($sale['model']) ?>
                                    </small>

                                </td>

                                <td>
                                    <?= esc($sale['serial_number']) ?>
                                </td>

                                <td>
                                    <?= esc($sale['customer_name']) ?>
                                </td>

                                <td>
                                    <?= esc($sale['purchase_date']) ?>
                                </td>

                                <td>
                                    <?= esc($sale['warranty_number'] ?? '-') ?>
                                </td>

                                <td>

                                    <?php if (($sale['warranty_status'] ?? '') === 'Garansi Aktif'): ?>

                                        <span class="badge badge-success">
                                            <?= esc($sale['warranty_status']) ?>
                                        </span>

                                    <?php else: ?>

                                        <span class="badge">
                                            <?= esc($sale['warranty_status'] ?? 'Belum tersedia') ?>
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <div class="table-actions">

                                        <button
                                            type="button"
                                            class="button button-icon button-icon-view"
                                            data-tooltip="Lihat Detail"
                                            aria-label="Lihat Detail"
                                            data-modal-open="sales-detail-modal-<?= esc($sale['id']) ?>">

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                aria-hidden="true">

                                                <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"></path>

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="2.5">
                                                </circle>

                                            </svg>

                                        </button>

                                        <button
                                            type="button"
                                            class="button button-icon button-icon-warranty"
                                            data-tooltip="Lihat Kartu Garansi"
                                            aria-label="Lihat Kartu Garansi"
                                            data-modal-open="warranty-card-modal-<?= esc($sale['id']) ?>">
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                aria-hidden="true">
                                                <path d="M6 3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" />
                                                <path d="M8 7h8" />
                                                <path d="M8 11h8" />
                                                <path d="M8 15h4" />
                                            </svg>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <?= view('components/pagination', [
                'pager' => $salesPager,
                'total' => $salesPager->getDetails('sales')['total'],
                'perPage' => 10,
                'group' => 'sales',
            ]) ?>

        <?php endif; ?>
    </div>
</div>


<?php foreach ($units as $unit): ?>

    <?= view('admin/sales/select', [
        'unit' => $unit,
    ]) ?>

    <?= view('admin/sales/customer', [
        'unit' => $unit,
        'customers' => $customers,
    ]) ?>

    <?= view('admin/sales/transaction', [
        'unit' => $unit,
    ]) ?>

<?php endforeach; ?>

<?php foreach ($sales as $sale): ?>

    <?= view('admin/sales/detail', [
        'sale' => $sale,
    ]) ?>

<?php endforeach; ?>

<?php foreach ($sales as $sale): ?>
    <?= view('admin/warranty/card', ['sale' => $sale]) ?>
<?php endforeach; ?>

<script>
    document.addEventListener('click', function(event) {

        const printButton = event.target.closest('[data-warranty-print]');

        if (!printButton) {
            return;
        }

        window.print();

    });
</script>

<?= $this->endSection() ?>
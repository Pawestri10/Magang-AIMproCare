<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>

<div class="page-header">

    <div>

        <h1>
            Klaim Garansi
        </h1>

        <p>
            Kelola pengajuan dan status klaim garansi pelanggan.
        </p>

    </div>

</div>


<div class="card">

    <form
        method="get"
        action="<?= site_url('admin/claims') ?>"
        class="table-toolbar">

        <div class="form-group">

            <label for="claim-search">
                Cari Klaim
            </label>

            <input
                type="search"
                id="claim-search"
                name="search"
                value="<?= esc($search) ?>"
                class="form-control"
                placeholder="Nomor klaim, serial, produk, atau pembeli">

        </div>


        <div class="form-group">

            <label for="claim-status">
                Status
            </label>

            <select
                id="claim-status"
                name="status"
                class="form-control">

                <option value="">
                    Semua Status
                </option>

                <?php foreach ($statuses as $claimStatus): ?>

                    <option
                        value="<?= esc($claimStatus) ?>"
                        <?= $status === $claimStatus ? 'selected' : '' ?>>

                        <?= esc($claimStatus) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <div class="table-toolbar-actions">

            <button
                type="submit"
                class="button button-primary">

                Cari

            </button>

            <?php if ($search !== '' || $status !== ''): ?>

                <a
                    href="<?= site_url('admin/claims') ?>"
                    class="button">

                    Reset

                </a>

            <?php endif; ?>

        </div>

    </form>


    <?php if (empty($claims)): ?>

        <div class="empty-state">

            <p>
                Belum ada klaim garansi yang ditemukan.
            </p>

        </div>

    <?php else: ?>

        <div class="table-wrapper">

            <table class="data-table">

                <thead>

                    <tr>

                        <th>
                            No.
                        </th>

                        <th>
                            Nomor Klaim
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
                            Status
                        </th>

                        <th>
                            Tanggal Pengajuan
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($claims as $index => $claim): ?>

                        <tr>

                            <td>
                                <?= esc($index + 1) ?>
                            </td>


                            <td>
                                <?= esc($claim['claim_number']) ?>
                            </td>


                            <td>

                                <div>
                                    <?= esc($claim['product_name']) ?>
                                </div>

                                <small>
                                    <?= esc($claim['brand']) ?>
                                    —
                                    <?= esc($claim['model']) ?>
                                </small>

                            </td>


                            <td>
                                <?= esc($claim['serial_number']) ?>
                            </td>


                            <td>
                                <?= esc($claim['customer_name']) ?>
                            </td>


                            <td>

                                <?php
                                $statusClass = match ($claim['status']) {
                                    'Selesai' => 'badge-success',
                                    'Klaim Diterima',
                                    'Barang Diterima',
                                    'Sedang Diperiksa',
                                    'Sedang Diproses' => 'badge-success',
                                    'Klaim Ditolak' => 'badge-danger',
                                    default => 'badge',
                                };
                                ?>

                                <span class="badge <?= esc($statusClass) ?>">
                                    <?= esc($claim['status']) ?>
                                </span>

                            </td>


                            <td>
                                <?= esc($claim['created_at']) ?>
                            </td>


                            <td>

                                <div class="table-actions">

                                    <a
                                        href="#"
                                        class="button button-icon button-icon-view"
                                        data-modal-open="claim-detail-modal-<?= esc($claim['id']) ?>"
                                        data-tooltip="Lihat Detail"
                                        aria-label="Lihat Detail">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">

                                            <path
                                                d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z">
                                            </path>

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5">
                                            </circle>

                                        </svg>

                                    </a>


                                    <button
                                        type="button"
                                        class="button button-icon button-icon-edit"
                                        data-modal-open="claim-edit-modal-<?= esc($claim['id']) ?>"
                                        data-tooltip="Edit"
                                        aria-label="Edit">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            aria-hidden="true">

                                            <path d="M12 20h9"></path>

                                            <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path>

                                        </svg>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>

        <?php foreach ($claims as $claim): ?>

            <?php if (isset($claimDetails[$claim['id']])): ?>

                <?= view('admin/claims/detail', [
                    'claim' => $claimDetails[$claim['id']],
                    'claimHistories' => $claimHistories[$claim['id']] ?? [],
                ]) ?>

            <?php endif; ?>

            <?= view('admin/claims/edit', [
                'claim' => $claim,
            ]) ?>

        <?php endforeach; ?>

        <?php if ($pager->getPageCount() > 1): ?>

            <div class="pagination-wrapper">

                <?= $pager->links() ?>

            </div>

        <?php endif; ?>

    <?php endif; ?>

</div>


<?= $this->endSection() ?>
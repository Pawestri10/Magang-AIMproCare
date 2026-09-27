<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>

<div class="page-header">

    <div>
        <h1>
            Master Data Produk
        </h1>

        <p>
            Kelola data produk AIMpro Care.
        </p>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success">

        <?= esc(session()->getFlashdata('success')) ?>

    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger">

        <?= esc(session()->getFlashdata('error')) ?>

    </div>
<?php endif; ?>

<div class="card">
    <div class="table-toolbar">

        <button
            type="button"
            class="button button-primary"
            data-modal-open="product-create-modal">

            + Tambah Produk

        </button>
    </div>

    <?php if (empty($products)): ?>

        <div class="empty-state">

            <p>
                Belum ada data produk.
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
                            Nama Produk
                        </th>

                        <th>
                            Brand
                        </th>

                        <th>
                            Model
                        </th>

                        <th>
                            Dibuat
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($products as $index => $product): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <?= esc($product['name']) ?>
                            </td>

                            <td>
                                <?= esc($product['brand']) ?>
                            </td>

                            <td>
                                <?= esc($product['model']) ?>
                            </td>

                            <td>
                                <?= esc($product['created_at']) ?>
                            </td>

                            <td>

                                <div class="table-actions">

                                    <button
                                        type="button"
                                        class="button button-icon button-icon-edit"
                                        aria-label="Edit produk"
                                        data-tooltip="Edit"
                                        data-modal-open="product-edit-modal-<?= esc($product['id']) ?>">

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

                                    <form
                                        id="product-delete-form-<?= esc($product['id']) ?>"
                                        method="post"
                                        action="<?= site_url('admin/products/' . $product['id'] . '/delete') ?>"
                                        class="table-action-form">

                                        <?= csrf_field() ?>

                                        <button
                                            type="button"
                                            class="button button-icon button-icon-danger"
                                            aria-label="Hapus produk"
                                            data-tooltip="Hapus"
                                            data-delete-modal-open="product-delete-modal-<?= esc($product['id']) ?>">

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                aria-hidden="true">

                                                <path d="M3 6h18"></path>

                                                <path d="M8 6V4h8v2"></path>

                                                <path d="M19 6l-1 14H6L5 6"></path>

                                                <path d="M10 11v5"></path>

                                                <path d="M14 11v5"></path>

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <?php foreach ($products as $product): ?>

            <?= view('admin/products/edit', [
                'product' => $product,
            ]) ?>

            <?= view('admin/products/delete', [
                'product' => $product,
            ]) ?>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?= $this->include('admin/products/create') ?>

<?= $this->endSection() ?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div>
        <h1>
            Master Data Pembeli
        </h1>

        <p>
            Kelola data pembeli AIMpro Care.
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
            data-modal-open="customer-create-modal">

            + Tambah Pembeli

        </button>

    </div>

    <?php if (empty($customers)): ?>

        <div class="empty-state">

            <p>
                Belum ada data pembeli.
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
                            Nama Pembeli
                        </th>

                        <th>
                            WhatsApp
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Alamat
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

                    <?php foreach ($customers as $index => $customer): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <?= esc($customer['name']) ?>
                            </td>

                            <td>
                                <?= esc($customer['whatsapp']) ?>
                            </td>

                            <td>
                                <?= $customer['email']
                                    ? esc($customer['email'])
                                    : '-' ?>
                            </td>

                            <td>
                                <?= esc($customer['address']) ?>
                            </td>

                            <td>
                                <?= esc($customer['created_at']) ?>
                            </td>

                            <td>

                                <div class="table-actions">

                                    <button
                                        type="button"
                                        class="button button-icon button-icon-edit"
                                        aria-label="Edit pembeli"
                                        data-tooltip="Edit"
                                        data-modal-open="customer-edit-modal-<?= esc($customer['id']) ?>">

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
                                        id="customer-delete-form-<?= esc($customer['id']) ?>"
                                        method="post"
                                        action="<?= site_url('admin/customers/' . $customer['id'] . '/delete') ?>"
                                        class="table-action-form">

                                        <?= csrf_field() ?>

                                        <button
                                            type="button"
                                            class="button button-icon button-icon-danger"
                                            aria-label="Hapus pembeli"
                                            data-tooltip="Hapus"
                                            data-delete-modal-open="customer-delete-modal-<?= esc($customer['id']) ?>">

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

        <?php foreach ($customers as $customer): ?>

            <?= view('admin/customers/edit', [
                'customer' => $customer,
            ]) ?>

            <?= view('admin/customers/delete', [
                'customer' => $customer,
            ]) ?>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?= $this->include('admin/customers/create') ?>

<?= $this->endSection() ?>
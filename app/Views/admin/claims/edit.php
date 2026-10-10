<div class="modal" id="claim-edit-modal-<?= esc($claim['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="claim-edit-title-<?= esc($claim['id']) ?>">

        <div class="modal-header">

            <div class="modal-heading">

                <h2 id="claim-edit-title-<?= esc($claim['id']) ?>">
                    Ubah Status Klaim
                </h2>

                <p>
                    Perbarui status penanganan klaim <?= esc($claim['claim_number']) ?>.
                </p>

            </div>


            <button
                type="button"
                class="modal-close"
                aria-label="Tutup"
                data-modal-close>

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true">

                    <path d="M6 6l12 12"></path>

                    <path d="M18 6L6 18"></path>

                </svg>

            </button>

        </div>


        <form
            method="post"
            action="<?= site_url('admin/claims/' . $claim['id'] . '/status') ?>"
            class="claim-form">

            <?= csrf_field() ?>


            <div class="modal-body">

                <div class="form-section">

                    <div class="form-section-heading">

                        <h3>
                            Status Klaim
                        </h3>

                        <p>
                            Pilih status terbaru dan berikan catatan penanganan.
                        </p>

                    </div>


                    <div class="form-fields">

                        <div class="form-group">

                            <label
                                for="claim-edit-status-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Status Baru

                                <span class="form-required">
                                    *
                                </span>

                            </label>

                            <?php
                            $statuses = [
                                'Pengajuan Baru',
                                'Sedang Diverifikasi',
                                'Klaim Diterima',
                                'Klaim Ditolak',
                                'Barang Diterima',
                                'Sedang Diperiksa',
                                'Sedang Diproses',
                                'Selesai',
                            ];
                            ?>

                            <select
                                id="claim-edit-status-<?= esc($claim['id']) ?>"
                                name="status"
                                class="form-input"
                                required>

                                <option value="">
                                    Pilih status
                                </option>

                                <?php foreach ($statuses as $status): ?>

                                    <?php if ($status === $claim['status']) continue; ?>

                                    <option value="<?= esc($status) ?>">
                                        <?= esc($status) ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                            <span class="form-helper">
                                Status saat ini:
                                <strong>
                                    <?= esc($claim['status']) ?>
                                </strong>
                            </span>

                        </div>


                        <div class="form-group">

                            <label
                                for="claim-edit-note-<?= esc($claim['id']) ?>"
                                class="form-label">

                                Catatan

                                <span class="form-required">
                                    *
                                </span>

                            </label>

                            <textarea
                                id="claim-edit-note-<?= esc($claim['id']) ?>"
                                name="note"
                                class="form-input"
                                rows="5"
                                maxlength="1000"
                                placeholder="Tuliskan catatan perubahan status..."
                                required></textarea>

                            <span class="form-helper">
                                Catatan akan disimpan sebagai bagian dari riwayat klaim.
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <div class="modal-footer-actions">

                    <button
                        type="button"
                        class="button button-secondary"
                        data-modal-close>

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="button button-primary">

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
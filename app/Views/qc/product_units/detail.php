<div
    class="modal"
    id="product-unit-detail-modal-<?= esc($unit['id']) ?>"
    aria-hidden="true">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog modal-dialog-large"
        role="dialog"
        aria-modal="true"
        aria-labelledby="product-unit-detail-title-<?= esc($unit['id']) ?>">

        <div class="modal-content">

            <div class="modal-header">

                <div>

                    <span class="eyebrow">
                        Detail Unit
                    </span>

                    <h2
                        id="product-unit-detail-title-<?= esc($unit['id']) ?>">

                        <?= esc($unit['serial_number']) ?>

                    </h2>

                </div>


                <button
                    type="button"
                    class="button button-icon"
                    data-modal-close
                    data-tooltip="Tutup"
                    aria-label="Tutup">

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


            <div class="modal-body">

                <div class="detail-grid">

                    <div class="form-group">

                        <span class="form-label">
                            Produk
                        </span>

                        <div class="detail-value">
                            <?= esc($unit['product_name']) ?>
                        </div>

                    </div>


                    <div class="form-group">

                        <span class="form-label">
                            Brand
                        </span>

                        <div class="detail-value">
                            <?= esc($unit['brand']) ?>
                        </div>

                    </div>


                    <div class="form-group">

                        <span class="form-label">
                            Model
                        </span>

                        <div class="detail-value">
                            <?= esc($unit['model']) ?>
                        </div>

                    </div>


                    <div class="form-group">

                        <span class="form-label">
                            Nomor Serial
                        </span>

                        <div class="detail-value">
                            <?= esc($unit['serial_number']) ?>
                        </div>

                    </div>


                    <div class="form-group">

                        <span class="form-label">
                            Status Unit
                        </span>

                        <?php
                        $statusClassMap = [
                            'Draft'                   => 'badge-muted',
                            'Menunggu QC'             => 'badge-info',
                            'Perlu Pemeriksaan Ulang' => 'badge-warning',
                            'Tidak Lolos QC'          => 'badge-danger',
                            'Siap Dijual'             => 'badge-success',
                            'Terjual'                 => 'badge-purple',
                            'Dikembalikan'            => 'badge-orange',
                        ];

                        $statusClass =
                            $statusClassMap[$unit['status']] ?? 'badge-muted';
                        ?>

                        <div>

                            <span class="badge <?= esc($statusClass) ?>">

                                <?= esc($unit['status']) ?>

                            </span>

                        </div>

                    </div>

                </div>


                <div class="section-heading">

                    <div>

                        <h3>
                            Riwayat Pemeriksaan QC
                        </h3>

                    </div>

                </div>


                <?php if (empty($inspections)): ?>

                    <div class="empty-state">

                        <p>
                            Belum ada riwayat pemeriksaan QC.
                        </p>

                    </div>

                <?php else: ?>

                    <div class="qc-history">

                        <?php foreach ($inspections as $inspection): ?>

                            <?php
                            $inspectionStatusClassMap = [
                                'Lolos QC'                => 'badge-success',
                                'Tidak Lolos QC'          => 'badge-danger',
                                'Perlu Pemeriksaan Ulang' => 'badge-warning',
                            ];

                            $inspectionStatusClass =
                                $inspectionStatusClassMap[$inspection['result']]
                                ?? 'badge-muted';
                            ?>

                            <article class="qc-history-item">

                                <div class="qc-history-header">

                                    <div>

                                        <span class="eyebrow">
                                            Pemeriksaan #<?= esc($inspection['id']) ?>
                                        </span>

                                        <h4>
                                            <?= esc($inspection['inspection_date']) ?>
                                        </h4>

                                    </div>


                                    <span class="badge <?= esc($inspectionStatusClass) ?>">

                                        <?= esc($inspection['result']) ?>

                                    </span>

                                </div>


                                <div class="detail-grid">

                                    <div class="form-group">

                                        <span class="form-label">
                                            Petugas QC
                                        </span>

                                        <div class="detail-value">
                                            <?= esc($inspection['officer_name']) ?>
                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <span class="form-label">
                                            Kondisi Fisik
                                        </span>

                                        <div class="detail-value">
                                            <?= esc($inspection['physical_condition']) ?>
                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <span class="form-label">
                                            Kelengkapan
                                        </span>

                                        <div class="detail-value">
                                            <?= esc($inspection['completeness']) ?>
                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <span class="form-label">
                                            Catatan
                                        </span>

                                        <div class="detail-value">

                                            <?= $inspection['notes']
                                                ? esc($inspection['notes'])
                                                : 'Tidak ada catatan.' ?>

                                        </div>

                                    </div>

                                </div>


                                <div class="qc-history-section">

                                    <div class="section-heading">

                                        <div>

                                            <h4>
                                                Hasil Checklist QC
                                            </h4>

                                        </div>

                                    </div>


                                    <div class="qc-checklist">

                                        <?php foreach ($inspection['checklist'] as $index => $item): ?>

                                            <div class="qc-checklist-item">

                                                <div class="qc-checklist-label">

                                                    <span class="qc-checklist-number">

                                                        <?= $index + 1 ?>

                                                    </span>

                                                    <span class="qc-checklist-text">

                                                        <?= esc($item['item_name']) ?>

                                                    </span>

                                                </div>


                                                <?php
                                                $checklistClass =
                                                    $item['result'] === 'Ya'
                                                    ? 'badge-success'
                                                    : 'badge-danger';
                                                ?>

                                                <span class="badge <?= esc($checklistClass) ?>">

                                                    <?= esc($item['result']) ?>

                                                </span>

                                            </div>

                                        <?php endforeach; ?>

                                    </div>

                                </div>


                                <div class="qc-history-section">

                                    <div class="section-heading">

                                        <div>

                                            <h4>
                                                Dokumentasi QC
                                            </h4>

                                        </div>

                                    </div>


                                    <div class="qc-documentation-grid">

                                        <?php foreach ($inspection['documentations'] as $documentation): ?>

                                            <?php
                                            $fileUrl = base_url('qc/documentations/' . $documentation['id']);
                                            ?>

                                            <?php if ($documentation['type'] === 'unboxing_video'): ?>

                                                <div class="qc-documentation-item">

                                                    <span class="form-label">
                                                        Video Unboxing
                                                    </span>

                                                    <video
                                                        class="qc-documentation-video"
                                                        controls
                                                        preload="metadata">

                                                        <source
                                                            src="<?= esc($fileUrl) ?>">

                                                        Browser tidak mendukung
                                                        pemutaran video.

                                                    </video>

                                                </div>

                                            <?php else: ?>

                                                <div class="qc-documentation-item">

                                                    <span class="form-label">

                                                        <?= $documentation['type'] === 'serial_photo'
                                                            ? 'Foto Nomor Serial'
                                                            : 'Foto Produk' ?>

                                                    </span>

                                                    <img
                                                        class="qc-documentation-image"
                                                        src="<?= esc($fileUrl) ?>"
                                                        alt="<?= esc(
                                                                    $documentation['type'] === 'serial_photo'
                                                                        ? 'Foto nomor serial produk'
                                                                        : 'Foto produk'
                                                                ) ?>">

                                                </div>

                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    </div>

                                </div>

                            </article>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="button button-secondary"
                    data-modal-close>

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>
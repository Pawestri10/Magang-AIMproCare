<div
    class="modal inspection-modal"
    id="product-unit-inspect-modal-<?= esc($unit['id']) ?>">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="product-unit-inspect-title">

        <div class="modal-header">

            <div class="modal-heading">

                <span class="modal-eyebrow">
                    Pemeriksaan QC
                </span>

                <h2 id="product-unit-inspect-title">
                    Pemeriksaan Unit Produk
                </h2>

                <p>
                    Periksa kondisi unit dan lengkapi dokumentasi QC.
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
            action="<?= base_url('qc/product-units/' . $unit['id'] . '/inspect') ?>"
            class="product-form"
            enctype="multipart/form-data">

            <?= csrf_field() ?>


            <div class="modal-body">

                <!-- Step 1 -->

                <section
                    class="inspection-step"
                    data-inspection-step="1">

                    <div class="form-section">

                        <div class="form-section-heading">

                            <span class="modal-eyebrow">
                                Tahap 1
                            </span>

                            <h3>
                                Data Unit & Dokumentasi
                            </h3>

                            <p class="text-muted">
                                Pastikan data unit sesuai dan lengkapi dokumentasi pemeriksaan.
                            </p>

                        </div>


                        <div class="form-fields">

                            <!-- Data Unit -->

                            <div class="form-section">

                                <div class="form-section-heading">

                                    <h3>
                                        Data Unit
                                    </h3>

                                </div>


                                <div class="form-row">

                                    <div class="form-group">

                                        <label class="form-label">
                                            Produk
                                        </label>

                                        <input
                                            type="text"
                                            class="form-input"
                                            value="<?= esc($unit['product_name']) ?>"
                                            readonly>

                                    </div>


                                    <div class="form-group">

                                        <label class="form-label">
                                            Brand
                                        </label>

                                        <input
                                            type="text"
                                            class="form-input"
                                            value="<?= esc($unit['brand']) ?>"
                                            readonly>

                                    </div>

                                </div>


                                <div class="form-row">

                                    <div class="form-group">

                                        <label class="form-label">
                                            Model
                                        </label>

                                        <input
                                            type="text"
                                            class="form-input"
                                            value="<?= esc($unit['model']) ?>"
                                            readonly>

                                    </div>


                                    <div class="form-group">

                                        <label class="form-label">
                                            Nomor Serial
                                        </label>

                                        <input
                                            type="text"
                                            class="form-input"
                                            value="<?= esc($unit['serial_number']) ?>"
                                            readonly>

                                    </div>

                                </div>

                            </div>


                            <!-- Dokumentasi -->

                            <div class="form-section">

                                <div class="form-section-heading">

                                    <h3>
                                        Dokumentasi Pemeriksaan
                                    </h3>

                                    <p class="text-muted">
                                        Unggah dokumentasi unit yang diperlukan untuk pemeriksaan QC.
                                    </p>

                                </div>


                                <div class="form-group">

                                    <label
                                        for="unboxing_video"
                                        class="form-label">

                                        Video Unboxing

                                        <span class="form-required">
                                            *
                                        </span>

                                    </label>

                                    <input
                                        type="file"
                                        id="unboxing_video"
                                        name="unboxing_video"
                                        class="form-input"
                                        accept="video/*"
                                        required>

                                </div>


                                <div class="form-group">

                                    <label
                                        for="serial_photo"
                                        class="form-label">

                                        Foto Nomor Serial

                                        <span class="form-required">
                                            *
                                        </span>

                                    </label>

                                    <input
                                        type="file"
                                        id="serial_photo"
                                        name="serial_photo"
                                        class="form-input"
                                        accept="image/*"
                                        required>

                                </div>


                                <div class="form-group">

                                    <label
                                        for="product_photo"
                                        class="form-label">

                                        Foto Produk

                                        <span class="form-required">
                                            *
                                        </span>

                                    </label>

                                    <input
                                        type="file"
                                        id="product_photo"
                                        name="product_photo"
                                        class="form-input"
                                        accept="image/*"
                                        required>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>


                <!-- Step 2 -->

                <section
                    class="inspection-step"
                    data-inspection-step="2"
                    hidden>

                    <div class="form-section">

                        <div class="form-section-heading">

                            <span class="modal-eyebrow">
                                Tahap 2
                            </span>

                            <h3>
                                Pemeriksaan & Hasil
                            </h3>

                            <p class="text-muted">
                                Periksa unit berdasarkan kondisi fisik, kelengkapan, dan checklist QC.
                            </p>

                        </div>


                        <!-- Kondisi Pemeriksaan -->

                        <div class="form-section">

                            <div class="form-section-heading">

                                <h3>
                                    Kondisi Pemeriksaan
                                </h3>

                            </div>


                            <div class="form-row">

                                <div class="form-group">

                                    <label
                                        for="physical_condition"
                                        class="form-label">

                                        Kondisi Fisik

                                        <span class="form-required">
                                            *
                                        </span>

                                    </label>

                                    <input
                                        type="text"
                                        id="physical_condition"
                                        name="physical_condition"
                                        class="form-input"
                                        maxlength="100"
                                        required>

                                </div>


                                <div class="form-group">

                                    <label
                                        for="completeness"
                                        class="form-label">

                                        Kelengkapan

                                        <span class="form-required">
                                            *
                                        </span>

                                    </label>

                                    <input
                                        type="text"
                                        id="completeness"
                                        name="completeness"
                                        class="form-input"
                                        maxlength="100"
                                        required>

                                </div>

                            </div>

                        </div>


                        <!-- Checklist QC -->

                        <div class="form-section">

                            <div class="form-section-heading">

                                <h3>
                                    Checklist QC
                                </h3>

                                <p class="text-muted">
                                    Periksa setiap item sesuai kondisi unit yang diperiksa.
                                </p>

                            </div>


                            <div class="qc-checklist">

                                <div class="qc-checklist-item">

                                    <div class="qc-checklist-label">

                                        <span class="qc-checklist-number">
                                            01
                                        </span>

                                        <span class="qc-checklist-text">
                                            Kemasan dalam kondisi baik
                                        </span>

                                    </div>


                                    <div class="qc-checklist-options">

                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[0][result]"
                                                value="Ya"
                                                required>

                                            <span>
                                                Ya
                                            </span>

                                        </label>


                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[0][result]"
                                                value="Tidak">

                                            <span>
                                                Tidak
                                            </span>

                                        </label>

                                    </div>

                                </div>


                                <div class="qc-checklist-item">

                                    <div class="qc-checklist-label">

                                        <span class="qc-checklist-number">
                                            02
                                        </span>

                                        <span class="qc-checklist-text">
                                            Produk tidak lecet atau retak
                                        </span>

                                    </div>


                                    <div class="qc-checklist-options">

                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[1][result]"
                                                value="Ya"
                                                required>

                                            <span>
                                                Ya
                                            </span>

                                        </label>


                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[1][result]"
                                                value="Tidak">

                                            <span>
                                                Tidak
                                            </span>

                                        </label>

                                    </div>

                                </div>


                                <div class="qc-checklist-item">

                                    <div class="qc-checklist-label">

                                        <span class="qc-checklist-number">
                                            03
                                        </span>

                                        <span class="qc-checklist-text">
                                            Nomor seri produk sesuai dengan kemasan
                                        </span>

                                    </div>


                                    <div class="qc-checklist-options">

                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[2][result]"
                                                value="Ya"
                                                required>

                                            <span>
                                                Ya
                                            </span>

                                        </label>


                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[2][result]"
                                                value="Tidak">

                                            <span>
                                                Tidak
                                            </span>

                                        </label>

                                    </div>

                                </div>


                                <div class="qc-checklist-item">

                                    <div class="qc-checklist-label">

                                        <span class="qc-checklist-number">
                                            04
                                        </span>

                                        <span class="qc-checklist-text">
                                            Kelengkapan produk sesuai
                                        </span>

                                    </div>


                                    <div class="qc-checklist-options">

                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[3][result]"
                                                value="Ya"
                                                required>

                                            <span>
                                                Ya
                                            </span>

                                        </label>


                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[3][result]"
                                                value="Tidak">

                                            <span>
                                                Tidak
                                            </span>

                                        </label>

                                    </div>

                                </div>


                                <div class="qc-checklist-item">

                                    <div class="qc-checklist-label">

                                        <span class="qc-checklist-number">
                                            05
                                        </span>

                                        <span class="qc-checklist-text">
                                            Produk dapat dinyalakan
                                        </span>

                                    </div>


                                    <div class="qc-checklist-options">

                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[4][result]"
                                                value="Ya"
                                                required>

                                            <span>
                                                Ya
                                            </span>

                                        </label>


                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[4][result]"
                                                value="Tidak">

                                            <span>
                                                Tidak
                                            </span>

                                        </label>

                                    </div>

                                </div>


                                <div class="qc-checklist-item">

                                    <div class="qc-checklist-label">

                                        <span class="qc-checklist-number">
                                            06
                                        </span>

                                        <span class="qc-checklist-text">
                                            Fungsi dasar berjalan
                                        </span>

                                    </div>


                                    <div class="qc-checklist-options">

                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[5][result]"
                                                value="Ya"
                                                required>

                                            <span>
                                                Ya
                                            </span>

                                        </label>


                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[5][result]"
                                                value="Tidak">

                                            <span>
                                                Tidak
                                            </span>

                                        </label>

                                    </div>

                                </div>


                                <div class="qc-checklist-item">

                                    <div class="qc-checklist-label">

                                        <span class="qc-checklist-number">
                                            07
                                        </span>

                                        <span class="qc-checklist-text">
                                            Tidak ditemukan kerusakan
                                        </span>

                                    </div>


                                    <div class="qc-checklist-options">

                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[6][result]"
                                                value="Ya"
                                                required>

                                            <span>
                                                Ya
                                            </span>

                                        </label>


                                        <label class="qc-checklist-option">

                                            <input
                                                type="radio"
                                                name="checklist[6][result]"
                                                value="Tidak">

                                            <span>
                                                Tidak
                                            </span>

                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- Catatan QC -->

                        <div class="form-section">

                            <div class="form-section-heading">

                                <h3>
                                    Catatan QC
                                </h3>

                            </div>


                            <div class="form-group">

                                <label
                                    for="notes"
                                    class="form-label">

                                    Catatan

                                </label>

                                <textarea
                                    id="notes"
                                    name="notes"
                                    class="form-textarea"
                                    rows="4"></textarea>

                            </div>

                        </div>


                        <!-- Hasil QC -->

                        <div class="form-section">

                            <div class="form-section-heading">

                                <h3>
                                    Hasil Pemeriksaan
                                </h3>

                                <p class="text-muted">
                                    Tentukan hasil akhir pemeriksaan QC.
                                </p>

                            </div>


                            <div class="form-group">

                                <label class="form-label">
                                    Hasil QC

                                    <span class="form-required">
                                        *
                                    </span>
                                </label>


                                <div class="form-options">

                                    <label class="form-option">

                                        <input
                                            type="radio"
                                            name="result"
                                            value="Lolos QC"
                                            required>

                                        <span>
                                            Lolos QC
                                        </span>

                                    </label>


                                    <label class="form-option">

                                        <input
                                            type="radio"
                                            name="result"
                                            value="Tidak Lolos QC">

                                        <span>
                                            Tidak Lolos QC
                                        </span>

                                    </label>


                                    <label class="form-option">

                                        <input
                                            type="radio"
                                            name="result"
                                            value="Perlu Pemeriksaan Ulang">

                                        <span>
                                            Perlu Pemeriksaan Ulang
                                        </span>

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

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
                        type="button"
                        class="button button-secondary"
                        data-inspection-back
                        hidden>

                        Kembali

                    </button>


                    <button
                        type="button"
                        class="button button-primary"
                        data-inspection-next>

                        Berikutnya

                    </button>

                    <button
                        type="submit"
                        class="button button-primary"
                        data-inspection-submit
                        hidden>

                        Simpan Pemeriksaan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
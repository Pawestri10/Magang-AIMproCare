<div
    class="modal"
    id="product-unit-create-modal">

    <div
        class="modal-backdrop"
        data-modal-close>
    </div>


    <div
        class="modal-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="product-unit-create-title">

        <div class="modal-header">

            <div class="modal-heading">

                <span class="modal-eyebrow">
                    Pemeriksaan QC
                </span>

                <h2 id="product-unit-create-title">
                    Tambah Unit Produk
                </h2>

                <p>
                    Tambahkan unit produk baru untuk proses pemeriksaan QC.
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


        <?php if (session()->getFlashdata('errors')): ?>

            <div class="modal-body">

                <div class="alert alert-danger">

                    <div class="alert-content">

                        <strong>
                            Data belum dapat disimpan.
                        </strong>

                        <ul>

                            <?php foreach (session()->getFlashdata('errors') as $error): ?>

                                <li>
                                    <?= esc($error) ?>
                                </li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                </div>

            </div>

        <?php endif; ?>


        <form
            method="post"
            action="<?= site_url('qc/product-units') ?>"
            class="product-form">

            <?= csrf_field() ?>


            <div class="modal-body">

                <div class="form-section">

                    <div class="form-section-heading">

                        <h3>
                            Data Unit Produk
                        </h3>

                        <p class="text-muted">
                            Pilih produk dan masukkan nomor serial unit yang akan diperiksa.
                        </p>

                    </div>


                    <div class="form-fields">

                        <div class="form-group">

                            <label
                                for="product_id"
                                class="form-label">

                                Produk

                                <span class="form-required">
                                    *
                                </span>

                            </label>


                            <select
                                id="product_id"
                                name="product_id"
                                class="form-input"
                                required>

                                <option value="">
                                    -- Pilih Produk --
                                </option>

                                <?php foreach ($products as $product): ?>

                                    <option
                                        value="<?= esc($product['id']) ?>"
                                        <?= old('product_id') == $product['id'] ? 'selected' : '' ?>>

                                        <?= esc($product['name']) ?>
                                        -
                                        <?= esc($product['brand']) ?>
                                        -
                                        <?= esc($product['model']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>


                            <span class="form-helper">
                                Pilih produk yang sesuai dengan unit yang akan diperiksa.
                            </span>

                        </div>


                        <div class="form-group">

                            <label
                                for="serial_number"
                                class="form-label">

                                Nomor Serial

                                <span class="form-required">
                                    *
                                </span>

                            </label>


                            <input
                                type="text"
                                id="serial_number"
                                name="serial_number"
                                class="form-input"
                                value="<?= old('serial_number') ?>"
                                maxlength="100"
                                placeholder="Masukkan nomor serial"
                                autocomplete="off"
                                required>


                            <span class="form-helper">
                                Nomor serial maksimal 100 karakter dan harus unik.
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

                        Simpan Unit

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
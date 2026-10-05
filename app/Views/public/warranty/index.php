<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<section class="public-warranty">
    <div class="public-warranty-container">

        <div class="public-warranty-header">
            <span class="public-warranty-label">AIMPro Technology</span>

            <h1>Cek Garansi</h1>

            <p>
                Periksa status dan masa berlaku garansi produk Anda
                menggunakan nomor garansi atau serial number.
            </p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="public-warranty-alert" role="alert">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <div class="public-warranty-card">
            <form
                action="<?= base_url('cek-garansi') ?>"
                method="post"
                class="public-warranty-form">
                <?= csrf_field() ?>

                <div class="public-form-group">
                    <label for="identifier">
                        Nomor Garansi / Serial Number
                    </label>

                    <input
                        type="text"
                        id="identifier"
                        name="identifier"
                        value="<?= esc(old('identifier')) ?>"
                        placeholder="Contoh: AIM-WRT-2026-000001"
                        autocomplete="off"
                        required>

                    <span class="public-form-help">
                        Masukkan nomor garansi atau serial number produk.
                    </span>
                </div>

                <button
                    type="submit"
                    class="public-warranty-submit">
                    Cek Garansi
                </button>
            </form>

            <div class="public-warranty-divider">
                <span>atau</span>
            </div>

            <button
                type="button"
                class="public-warranty-scan"
                id="open-qr-scanner">
                <span class="public-warranty-scan-icon">▣</span>
                <span>Scan QR Code</span>
            </button>
        </div>

    </div>
</section>

<div
    class="qr-scanner-modal"
    id="qr-scanner-modal"
    hidden>
    <div
        class="qr-scanner-backdrop"
        data-qr-close></div>

    <div
        class="qr-scanner-dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="qr-scanner-title">
        <div class="qr-scanner-header">
            <div>
                <span class="qr-scanner-label">
                    AIMPro Technology
                </span>

                <h2 id="qr-scanner-title">
                    Scan QR Code
                </h2>
            </div>

            <button
                type="button"
                class="qr-scanner-close"
                id="close-qr-scanner"
                aria-label="Tutup scanner">
                ×
            </button>
        </div>

        <div class="qr-scanner-body">
            <div
                class="qr-reader"
                id="qr-reader"></div>

            <p
                class="qr-scanner-status"
                id="qr-scanner-status">
                Arahkan kamera ke QR Code pada kartu garansi.
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script
    src="<?= base_url('assets/js/pages/public-warranty.js') ?>">
</script>

<?= $this->endSection() ?>
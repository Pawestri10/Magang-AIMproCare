<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<section class="public-claim">
    <div class="public-claim-container">

        <div class="public-claim-header">
            <span class="public-claim-label">
                AIMPro Technology
            </span>

            <h1>Ajukan Klaim Garansi</h1>

            <p>
                Isi informasi berikut untuk mengajukan klaim garansi produk Anda.
            </p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="public-claim-alert" role="alert">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <div class="public-claim-card">

            <form
                action="<?= base_url('klaim-garansi') ?>"
                method="post"
                enctype="multipart/form-data"
                class="public-claim-form">

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
                        placeholder="Masukkan nomor garansi atau serial number"
                        autocomplete="off"
                        required>

                    <span class="public-form-help">
                        Gunakan nomor garansi atau serial number produk.
                    </span>
                </div>

                <div class="public-form-group">
                    <label for="complaint">
                        Keluhan / Kerusakan
                    </label>

                    <textarea
                        id="complaint"
                        name="complaint"
                        rows="5"
                        placeholder="Jelaskan keluhan atau kerusakan produk"
                        required><?= esc(old('complaint')) ?></textarea>
                </div>

                <div class="public-form-group">
                    <label for="damage_started_at">
                        Tanggal Mulai Kerusakan
                    </label>

                    <input
                        type="date"
                        id="damage_started_at"
                        name="damage_started_at"
                        value="<?= esc(old('damage_started_at')) ?>"
                        required>
                </div>

                <div class="public-form-group">
                    <label for="damage_photo">
                        Foto Kerusakan
                    </label>

                    <input
                        type="file"
                        id="damage_photo"
                        name="damage_photo"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        required>

                    <span class="public-form-help">
                        Foto kerusakan wajib diunggah.
                    </span>
                </div>

                <div class="public-form-group">
                    <label for="damage_video">
                        Video Kerusakan
                        <span>(opsional)</span>
                    </label>

                    <input
                        type="file"
                        id="damage_video"
                        name="damage_video"
                        accept=".mp4,.mov,.webm,video/mp4,video/quicktime,video/webm">

                    <span class="public-form-help">
                        Video bersifat opsional.
                    </span>
                </div>

                <div class="public-form-group">
                    <label for="whatsapp">
                        Nomor WhatsApp
                    </label>

                    <input
                        type="text"
                        id="whatsapp"
                        name="whatsapp"
                        value="<?= esc(old('whatsapp')) ?>"
                        placeholder="Contoh: 081234567890"
                        required>
                </div>

                <div class="public-form-group">
                    <label for="delivery_method">
                        Metode Penyerahan / Pengiriman
                    </label>

                    <select
                        id="delivery_method"
                        name="delivery_method"
                        required>

                        <option value="">
                            Pilih metode
                        </option>

                        <option
                            value="Penyerahan Langsung"
                            <?= old('delivery_method') === 'Penyerahan Langsung' ? 'selected' : '' ?>>
                            Penyerahan Langsung
                        </option>

                        <option
                            value="Pengiriman"
                            <?= old('delivery_method') === 'Pengiriman' ? 'selected' : '' ?>>
                            Pengiriman
                        </option>

                    </select>
                </div>

                <div class="public-form-group">
                    <label for="shipping_address">
                        Alamat Pengiriman
                    </label>

                    <textarea
                        id="shipping_address"
                        name="shipping_address"
                        rows="4"
                        placeholder="Isi jika metode menggunakan pengiriman"><?= esc(old('shipping_address')) ?></textarea>

                    <span class="public-form-help">
                        Isi bila diperlukan untuk proses pengiriman.
                    </span>
                </div>

                <div class="public-claim-agreement">
                    <label>
                        <input
                            type="checkbox"
                            name="agreement"
                            value="1"
                            <?= old('agreement') === '1' ? 'checked' : '' ?>>

                        <span>
                            Saya menyetujui ketentuan pengajuan klaim garansi.
                        </span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="public-claim-submit">
                    Ajukan Klaim
                </button>

            </form>

        </div>

    </div>
</section>

<?= $this->endSection() ?>
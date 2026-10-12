<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="notification-settings-page">

    <div class="notification-settings-header">
        <div class="notification-settings-header-icon">
            <svg viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.7"
                aria-hidden="true">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path>
                <path d="M10 21h4"></path>
            </svg>
        </div>

        <div>
            <h1>Pengaturan Notifikasi WhatsApp</h1>
            <p>Kelola template pesan dan konfigurasi WAKITA.</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="notification-alert notification-alert-success" role="alert">
            <span class="notification-alert-icon">✓</span>
            <div>
                <strong>Berhasil</strong>
                <p><?= esc(session()->getFlashdata('success')) ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="notification-alert notification-alert-error" role="alert">
            <span class="notification-alert-icon">!</span>
            <div>
                <strong>Terjadi kesalahan</strong>
                <p><?= esc(session()->getFlashdata('error')) ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <?php if (! empty($errors)): ?>
        <div class="notification-alert notification-alert-error" role="alert">
            <span class="notification-alert-icon">!</span>
            <div>
                <strong>Periksa kembali data berikut</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <section class="notification-settings-card">
        <div class="notification-card-heading">
            <div class="notification-card-icon">
                <svg viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.7"
                    aria-hidden="true">
                    <rect x="4" y="10" width="16" height="11" rx="2"></rect>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                    <circle cx="12" cy="15" r="1"></circle>
                </svg>
            </div>

            <div>
                <h2>Konfigurasi WAKITA</h2>
                <p>Pengaturan koneksi layanan WhatsApp.</p>
            </div>
        </div>

        <div class="notification-api-status">
            <span class="notification-status-indicator <?= $apiKeyConfigured ? 'is-configured' : 'is-unconfigured' ?>"></span>

            <span>Status API key</span>

            <strong>
                <?= $apiKeyConfigured ? 'Sudah tersimpan' : 'Belum dikonfigurasi' ?>
            </strong>
        </div>

        <p class="notification-settings-hint">
            API key lama tidak ditampilkan demi keamanan.
            Masukkan key baru jika ingin menggantinya.
        </p>

        <form
            action="<?= site_url('admin/notification-settings/api-key') ?>"
            method="post"
            class="notification-settings-form">

            <?= csrf_field() ?>

            <div class="notification-form-group">
                <label for="api_key">API key baru</label>

                <input
                    type="password"
                    name="api_key"
                    id="api_key"
                    autocomplete="new-password"
                    required
                    maxlength="1000"
                    placeholder="Masukkan API key WAKITA">
            </div>

            <div class="notification-form-actions">
                <button type="submit" class="notification-button">
                    <svg viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8"
                        aria-hidden="true">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h12l6 6v10a2 2 0 0 1-2 2Z"></path>
                        <path d="M17 21v-8H7v8M7 3v5h8"></path>
                    </svg>
                    Simpan API Key
                </button>
            </div>
        </form>
    </section>

    <form
        action="<?= site_url('admin/notification-settings/save') ?>"
        method="post"
        class="notification-settings-form notification-settings-main-form">

        <?= csrf_field() ?>

        <section class="notification-settings-card">
            <div class="notification-card-heading">
                <div class="notification-card-icon">
                    <svg viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.7"
                        aria-hidden="true">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 7v5l3 2"></path>
                    </svg>
                </div>

                <div>
                    <h2>Pengingat Garansi</h2>
                    <p>Atur waktu pengingat sebelum masa garansi berakhir.</p>
                </div>
            </div>

            <div class="notification-form-group">
                <label for="expiry_reminder_days">
                    Kirim pengingat berapa hari sebelum garansi berakhir?
                </label>

                <div class="notification-input-with-suffix">
                    <input
                        type="number"
                        id="expiry_reminder_days"
                        name="expiry_reminder_days"
                        min="0"
                        max="365"
                        required
                        value="<?= esc(old('expiry_reminder_days', $expiryReminderDays)) ?>">

                    <span>Hari</span>
                </div>

                <p class="notification-settings-hint">
                    Nilai 0 berarti pada tanggal berakhirnya garansi.
                    Pengiriman otomatis memerlukan proses terjadwal yang akan
                    dibuat pada tahap berikutnya.
                </p>
            </div>
        </section>

        <?php foreach ($templates as $key => $template): ?>
            <section class="notification-settings-card">

                <div class="notification-card-heading">
                    <div class="notification-card-icon">
                        <svg viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.7"
                            aria-hidden="true">
                            <path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8A8.5 8.5 0 0 1 8.7 3.9a8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8v.5Z"></path>
                        </svg>
                    </div>

                    <div>
                        <h2><?= esc($template['label']) ?></h2>
                        <p><?= esc($template['description']) ?></p>
                    </div>
                </div>

                <div class="notification-form-group">
                    <label for="template_<?= esc($key) ?>">
                        Isi pesan
                    </label>

                    <textarea
                        id="template_<?= esc($key) ?>"
                        name="template_<?= esc($key) ?>"
                        rows="4"
                        maxlength="2000"
                        required><?= esc(old('template_' . $key, $template['content'])) ?></textarea>
                </div>

            </section>
        <?php endforeach; ?>

        <div class="notification-settings-footer">
            <button type="submit" class="notification-button notification-button-primary">
                <svg viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8"
                    aria-hidden="true">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h12l6 6v10a2 2 0 0 1-2 2Z"></path>
                    <path d="M17 21v-8H7v8M7 3v5h8"></path>
                </svg>
                Simpan Pengaturan
            </button>
        </div>

    </form>

</div>

<?= $this->endSection() ?>
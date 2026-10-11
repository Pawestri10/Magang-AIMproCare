<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto px-4 py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Pengaturan Notifikasi WhatsApp
        </h1>

        <p class="mt-2 text-sm text-slate-600">
            Kelola template pesan dan konfigurasi WAKITA.
        </p>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-800">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-800">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <?php if (! empty($errors)): ?>
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-800">
            <ul class="list-disc pl-5">
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="mb-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-slate-800">
            Konfigurasi WAKITA
        </h2>

        <p class="mt-2 text-sm text-slate-600">
            Status penyimpanan API key:
            <strong>
                <?= $apiKeyConfigured ? 'Sudah tersimpan' : 'Belum dikonfigurasi' ?>
            </strong>
        </p>

        <p class="mt-2 text-xs text-slate-500">
            API key lama tidak ditampilkan. Masukkan key baru untuk menggantinya.
        </p>

        <form
            action="<?= site_url('admin/notification-settings/api-key') ?>"
            method="post"
            class="mt-4 space-y-3">
            <?= csrf_field() ?>

            <label for="api_key" class="block text-sm font-medium text-slate-700">
                API key baru
            </label>

            <input
                type="password"
                name="api_key"
                id="api_key"
                autocomplete="new-password"
                required
                maxlength="1000"
                class="w-full rounded-lg border border-slate-300 px-4 py-3"
                placeholder="Masukkan API key WAKITA">

            <button
                type="submit"
                class="rounded-lg bg-green-700 px-5 py-3 font-medium text-white hover:bg-green-800">
                Simpan API Key
            </button>
        </form>
    </div>

    <form
        action="<?= site_url('admin/notification-settings/save') ?>"
        method="post"
        class="space-y-6">
        <?= csrf_field() ?>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-800">
                Pengingat Garansi
            </h2>

            <label for="expiry_reminder_days" class="mt-4 block text-sm font-medium text-slate-700">
                Kirim pengingat berapa hari sebelum garansi berakhir?
            </label>

            <input
                type="number"
                id="expiry_reminder_days"
                name="expiry_reminder_days"
                min="0"
                max="365"
                required
                value="<?= esc(old('expiry_reminder_days', $expiryReminderDays)) ?>"
                class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3">

            <p class="mt-2 text-xs text-slate-500">
                Nilai 0 berarti pada tanggal berakhirnya garansi. Pengiriman otomatis
                memerlukan proses terjadwal yang akan kita buat pada tahap berikutnya.
            </p>
        </div>

        <?php foreach ($templates as $key => $template): ?>
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-800">
                    <?= esc($template['label']) ?>
                </h2>

                <p class="mt-1 text-sm text-slate-600">
                    <?= esc($template['description']) ?>
                </p>

                <label
                    for="template_<?= esc($key) ?>"
                    class="mt-4 block text-sm font-medium text-slate-700">
                    Isi pesan
                </label>

                <textarea
                    id="template_<?= esc($key) ?>"
                    name="template_<?= esc($key) ?>"
                    rows="4"
                    maxlength="2000"
                    required
                    class="mt-2 w-full rounded-lg border border-slate-300 px-4 py-3"><?= esc(old('template_' . $key, $template['content'])) ?></textarea>
            </div>
        <?php endforeach; ?>

        <div class="flex justify-end">
            <button
                type="submit"
                class="rounded-lg bg-green-700 px-6 py-3 font-semibold text-white hover:bg-green-800">
                Simpan Pengaturan
            </button>
        </div>
    </form>

</div>

<?= $this->endSection() ?>
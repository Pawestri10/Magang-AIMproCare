<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($reportTitle) ?></title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        h1 {
            font-size: 18px;
            margin-bottom: 6px;
        }

        p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #dcefe2;
        }

        .footer {
            margin-top: 14px;
            color: #64748b;
        }
    </style>
</head>

<body>
    <h1>AIMpro Care</h1>
    <h2><?= esc($reportTitle) ?></h2>

    <p>
        Periode:
        <?= esc($filters['start_date'] ?: 'Awal data') ?>
        sampai
        <?= esc($filters['end_date'] ?: 'Tanggal terakhir') ?>
    </p>

    <p>Jumlah data: <?= count($rows) ?></p>

    <table>
        <thead>
            <tr>
                <?php foreach ($columns as $column): ?>
                    <th><?= esc($column['label']) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($rows)): ?>
                <tr>
                    <td colspan="<?= count($columns) ?>">
                        Tidak ada data untuk filter yang dipilih.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($columns as $column): ?>
                            <td>
                                <?= esc($row[$column['key']] ?? '-') ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <p class="footer">
        Dibuat pada <?= esc($generatedAt) ?>.
        Dokumen ini dihasilkan dari data database AIMpro Care.
    </p>
</body>

</html>
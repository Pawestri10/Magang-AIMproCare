<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends BaseController
{
    private array $reportTypes = [
        'qc',
        'units',
        'warranties',
        'claims',
    ];

    private int $reportTotalRows = 0;

    public function index()
    {
        $filters = $this->getFilters();
        $type = $filters['type'];

        $rows = $this->getReportRows($type, $filters, true);
        $pager = service('pager');

        return view('admin/reports/index', [
            'title' => 'Laporan AIMpro Care',
            'filters' => $filters,
            'reportTypes' => $this->reportTypes,
            'reportTitle' => $this->getReportTitle($type),
            'columns' => $this->getColumns($type),
            'rows' => $rows,
            'pager' => $pager,
            'totalRows' => $this->reportTotalRows,
            'perPage' => 10,
            'officers' => db_connect()
                ->table('users')
                ->select('id, name')
                ->where('role', 'Petugas QC')
                ->where('deleted_at', null)
                ->orderBy('name', 'ASC')
                ->get()
                ->getResultArray(),
        ]);
    }

    public function exportExcel()
    {
        $filters = $this->getFilters();
        $type = $filters['type'];
        $rows = $this->getReportRows($type, $filters);
        $columns = $this->getColumns($type);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Laporan');

        $sheet->setCellValue('A1', 'LAPORAN AIMpro CARE');
        $sheet->setCellValue('A2', $this->getReportTitle($type));
        $sheet->setCellValue(
            'A3',
            'Periode: ' . ($filters['start_date'] ?: 'Awal data')
                . ' s/d ' . ($filters['end_date'] ?: 'Tanggal terakhir')
        );

        $lastColumn = $this->columnLetter(count($columns));

        $sheet->mergeCells("A1:{$lastColumn}1");
        $sheet->mergeCells("A2:{$lastColumn}2");
        $sheet->mergeCells("A3:{$lastColumn}3");

        $headerRow = 5;

        foreach ($columns as $index => $column) {
            $letter = $this->columnLetter($index + 1);

            $sheet->setCellValue(
                $letter . $headerRow,
                $column['label']
            );
        }

        $rowNumber = $headerRow + 1;

        foreach ($rows as $row) {
            foreach ($columns as $index => $column) {
                $letter = $this->columnLetter($index + 1);
                $value = $row[$column['key']] ?? '-';

                $sheet->setCellValue(
                    $letter . $rowNumber,
                    (string) $value
                );
            }

            $rowNumber++;
        }

        $sheet->getStyle("A1:{$lastColumn}1")
            ->getFont()
            ->setBold(true)
            ->setSize(16);

        $sheet->getStyle("A2:{$lastColumn}2")
            ->getFont()
            ->setBold(true);

        $sheet->getStyle("A{$headerRow}:{$lastColumn}{$headerRow}")
            ->getFont()
            ->setBold(true);

        $sheet->getStyle("A{$headerRow}:{$lastColumn}{$headerRow}")
            ->getFill()
            ->setFillType('solid')
            ->getStartColor()
            ->setARGB('FFDCEFE2');

        foreach (range(1, count($columns)) as $index) {
            $sheet->getColumnDimension(
                $this->columnLetter($index)
            )->setAutoSize(true);
        }

        $filename = 'laporan-' . $type . '-' . date('Ymd-His') . '.xlsx';

        $writer = new Xlsx($spreadsheet);

        ob_start();
        $writer->save('php://output');
        $content = ob_get_clean();

        $spreadsheet->disconnectWorksheets();

        return $this->response
            ->download($filename, $content)
            ->setContentType(
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            );
    }

    public function exportPdf()
    {
        $filters = $this->getFilters();
        $type = $filters['type'];

        $data = [
            'reportTitle' => $this->getReportTitle($type),
            'columns' => $this->getColumns($type),
            'rows' => $this->getReportRows($type, $filters),
            'filters' => $filters,
            'generatedAt' => date('d-m-Y H:i:s'),
        ];

        $html = view('admin/reports/pdf', $data);

        $options = new Options();
        $options->set('isRemoteEnabled', false);

        $pdf = new Dompdf($options);
        $pdf->loadHtml($html, 'UTF-8');
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $this->response->download(
            'laporan-' . $type . '-' . date('Ymd-His') . '.pdf',
            $pdf->output()
        )->setContentType('application/pdf');
    }

    private function getFilters(): array
    {
        $request = $this->request;

        $type = $request->getGet('type') ?? 'qc';

        if (!in_array($type, $this->reportTypes, true)) {
            $type = 'qc';
        }

        $startDate = trim((string) $request->getGet('start_date'));
        $endDate = trim((string) $request->getGet('end_date'));

        if (
            $startDate !== ''
            && ! $this->isValidDate($startDate)
        ) {
            $startDate = '';
        }

        if (
            $endDate !== ''
            && ! $this->isValidDate($endDate)
        ) {
            $endDate = '';
        }

        if (
            $startDate !== ''
            && $endDate !== ''
            && $startDate > $endDate
        ) {
            [$startDate, $endDate] = [$endDate, $startDate];
        }

        return [
            'type' => $type,
            'search' => trim((string) $request->getGet('search')),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'officer_id' => trim(
                (string) $request->getGet('officer_id')
            ),
            'result' => trim(
                (string) $request->getGet('result')
            ),
            'unit_status' => trim(
                (string) $request->getGet('unit_status')
            ),
            'warranty_status' => trim(
                (string) $request->getGet('warranty_status')
            ),
            'claim_status' => trim(
                (string) $request->getGet('claim_status')
            ),
        ];
    }

    private function isValidDate(string $date): bool
    {
        $parsed = \DateTimeImmutable::createFromFormat('!Y-m-d', $date);

        return $parsed !== false
            && $parsed->format('Y-m-d') === $date;
    }

    private function getReportRows(
        string $type,
        array $filters,
        bool $paginate = false
    ): array {
        return match ($type) {
            'qc' => $this->getQcRows($filters, $paginate),
            'units' => $this->getUnitRows($filters, $paginate),
            'warranties' => $this->getWarrantyRows($filters, $paginate),
            'claims' => $this->getClaimRows($filters, $paginate),
            default => [],
        };
    }

    private function finishReportQuery($builder, bool $paginate): array
    {
        if (! $paginate) {
            return $builder->get()->getResultArray();
        }

        $perPage = 10;
        $page = max(1, (int) $this->request->getGet('page'));

        $this->reportTotalRows = $builder->countAllResults(false);

        if ($this->reportTotalRows === 0) {
            return [];
        }

        $totalPages = (int) ceil($this->reportTotalRows / $perPage);
        $page = min($page, $totalPages);

        $pager = service('pager');

        $pager->makeLinks(
            $page,
            $perPage,
            $this->reportTotalRows,
            'default_full',
            0,
            'default'
        );

        return $builder
            ->get($perPage, ($page - 1) * $perPage)
            ->getResultArray();
    }

    private function applyDateFilter(
        $builder,
        array $filters,
        string $column
    ) {
        if ($filters['start_date'] !== '') {
            $builder->where(
                $column . ' >=',
                $filters['start_date']
            );
        }

        if ($filters['end_date'] !== '') {
            $builder->where(
                $column . ' <=',
                $filters['end_date']
            );
        }

        return $builder;
    }

    private function applySearchFilter(
        $builder,
        string $search,
        array $columns
    ) {
        $search = trim($search);

        if ($search === '') {
            return $builder;
        }

        $builder->groupStart();

        foreach ($columns as $index => $column) {
            if ($index === 0) {
                $builder->like($column, $search);
            } else {
                $builder->orLike($column, $search);
            }
        }

        $builder->groupEnd();

        return $builder;
    }

    private function getQcRows(array $filters, bool $paginate = false): array
    {
        $builder = db_connect()->table('qc_inspections qi')
            ->select("
                qi.id,
                qi.inspection_date,
                qi.physical_condition,
                qi.completeness,
                qi.result,
                qi.notes,
                u.name AS officer_name,
                pu.serial_number,
                p.name AS product_name,
                p.brand,
                p.model
            ")
            ->join('users u', 'u.id = qi.user_id')
            ->join('product_units pu', 'pu.id = qi.product_unit_id')
            ->join('products p', 'p.id = pu.product_id')
            ->where('p.deleted_at', null);

        $this->applyDateFilter(
            $builder,
            $filters,
            'qi.inspection_date'
        );


        $this->applySearchFilter(
            $builder,
            $filters['search'],
            [
                'pu.serial_number',
                'p.name',
                'p.brand',
            ]
        );

        if ($filters['officer_id'] !== '') {
            $builder->where('qi.user_id', (int) $filters['officer_id']);
        }

        $allowedResults = [
            'Lolos QC',
            'Tidak Lolos QC',
            'Perlu Pemeriksaan Ulang',
        ];

        if (in_array($filters['result'], $allowedResults, true)) {
            $builder->where('qi.result', $filters['result']);
        }

        return $this->finishReportQuery(
            $builder
                ->orderBy('qi.inspection_date', 'DESC')
                ->orderBy('qi.id', 'DESC'),
            $paginate
        );
    }

    private function getUnitRows(array $filters, bool $paginate = false): array
    {
        $builder = db_connect()->table('product_units pu')
            ->select("
                pu.id,
                pu.serial_number,
                pu.status,
                p.name AS product_name,
                p.brand,
                p.model
            ")
            ->join('products p', 'p.id = pu.product_id')
            ->where('p.deleted_at', null)
            ->whereIn('pu.status', ['Siap Dijual', 'Terjual']);

        if (in_array(
            $filters['unit_status'],
            ['Siap Dijual', 'Terjual'],
            true
        )) {
            $builder->where('pu.status', $filters['unit_status']);
        }

        $this->applyDateFilter(
            $builder,
            $filters,
            'pu.created_at'
        );


        $this->applySearchFilter(
            $builder,
            $filters['search'],
            [
                'pu.serial_number',
                'p.name',
                'p.brand',
            ]
        );

        return $this->finishReportQuery(
            $builder->orderBy('pu.id', 'DESC'),
            $paginate
        );
    }

    private function getWarrantyRows(array $filters, bool $paginate = false): array
    {
        $builder = db_connect()->table('warranties w')
            ->select("
                w.id,
                w.warranty_number,
                w.start_date,
                w.end_date,
                w.status,
                s.invoice_number,
                pu.serial_number,
                p.name AS product_name,
                p.brand,
                p.model
            ")
            ->join('sales s', 's.id = w.sale_id')
            ->join('product_units pu', 'pu.id = s.product_unit_id')
            ->join('products p', 'p.id = pu.product_id')
            ->where('p.deleted_at', null);

        $this->applyDateFilter(
            $builder,
            $filters,
            'w.start_date'
        );

        $this->applySearchFilter(
            $builder,
            $filters['search'],
            [
                'pu.serial_number',
                'p.name',
                'p.brand',
            ]
        );

        if ($filters['warranty_status'] === 'aktif') {
            $builder->where('w.start_date <=', date('Y-m-d'))
                ->where('w.end_date >=', date('Y-m-d'));
        } elseif ($filters['warranty_status'] === 'berakhir') {
            $builder->where('w.end_date <', date('Y-m-d'));
        }

        return $this->finishReportQuery(
            $builder->orderBy('w.end_date', 'ASC'),
            $paginate
        );
    }

    private function getClaimRows(array $filters, bool $paginate = false): array
    {
        $builder = db_connect()->table('warranty_claims wc')
            ->select("
                wc.id,
                wc.claim_number,
                wc.created_at,
                wc.status,
                w.warranty_number,
                w.end_date,
                pu.serial_number,
                p.name AS product_name,
                p.brand,
                p.model
            ")
            ->join('warranties w', 'w.id = wc.warranty_id')
            ->join('sales s', 's.id = w.sale_id')
            ->join('product_units pu', 'pu.id = s.product_unit_id')
            ->join('products p', 'p.id = pu.product_id')
            ->where('p.deleted_at', null);

        $this->applyDateFilter(
            $builder,
            $filters,
            'wc.created_at'
        );


        $this->applySearchFilter(
            $builder,
            $filters['search'],
            [
                'pu.serial_number',
                'p.name',
                'p.brand',
            ]
        );

        $allowedStatuses = [
            'Pengajuan Baru',
            'Sedang Diverifikasi',
            'Klaim Diterima',
            'Klaim Ditolak',
            'Barang Diterima',
            'Sedang Diperiksa',
            'Sedang Diproses',
            'Selesai',
        ];

        if (in_array($filters['claim_status'], $allowedStatuses, true)) {
            $builder->where('wc.status', $filters['claim_status']);
        }

        return $this->finishReportQuery(
            $builder
                ->orderBy('wc.created_at', 'DESC')
                ->orderBy('wc.id', 'DESC'),
            $paginate
        );
    }

    private function getReportTitle(string $type): string
    {
        return match ($type) {
            'qc' => 'Rekap Pemeriksaan QC',
            'units' => 'Laporan Unit Siap Dijual dan Terjual',
            'warranties' => 'Laporan Garansi',
            'claims' => 'Laporan Klaim Garansi',
            default => 'Laporan AIMpro Care',
        };
    }

    private function getColumns(string $type): array
    {
        return match ($type) {
            'qc' => [
                ['key' => 'inspection_date', 'label' => 'Tanggal QC'],
                ['key' => 'serial_number', 'label' => 'Nomor Seri'],
                ['key' => 'product_name', 'label' => 'Produk'],
                ['key' => 'brand', 'label' => 'Brand'],
                ['key' => 'model', 'label' => 'Model'],
                ['key' => 'officer_name', 'label' => 'Petugas'],
                ['key' => 'physical_condition', 'label' => 'Kondisi Fisik'],
                ['key' => 'completeness', 'label' => 'Kelengkapan'],
                ['key' => 'result', 'label' => 'Hasil QC'],
                ['key' => 'notes', 'label' => 'Catatan'],
            ],
            'units' => [
                ['key' => 'serial_number', 'label' => 'Nomor Seri'],
                ['key' => 'product_name', 'label' => 'Produk'],
                ['key' => 'brand', 'label' => 'Brand'],
                ['key' => 'model', 'label' => 'Model'],
                ['key' => 'status', 'label' => 'Status Unit'],
            ],
            'warranties' => [
                ['key' => 'warranty_number', 'label' => 'Nomor Garansi'],
                ['key' => 'serial_number', 'label' => 'Nomor Seri'],
                ['key' => 'product_name', 'label' => 'Produk'],
                ['key' => 'brand', 'label' => 'Brand'],
                ['key' => 'invoice_number', 'label' => 'Nomor Invoice'],
                ['key' => 'start_date', 'label' => 'Mulai Garansi'],
                ['key' => 'end_date', 'label' => 'Akhir Garansi'],
                ['key' => 'status', 'label' => 'Status Tersimpan'],
            ],
            'claims' => [
                ['key' => 'claim_number', 'label' => 'Nomor Klaim'],
                ['key' => 'warranty_number', 'label' => 'Nomor Garansi'],
                ['key' => 'serial_number', 'label' => 'Nomor Seri'],
                ['key' => 'product_name', 'label' => 'Produk'],
                ['key' => 'created_at', 'label' => 'Tanggal Pengajuan'],
                ['key' => 'status', 'label' => 'Status Klaim'],
            ],
            default => [],
        };
    }

    private function columnLetter(int $number): string
    {
        $letter = '';

        while ($number > 0) {
            $remainder = ($number - 1) % 26;

            $letter = chr(65 + $remainder) . $letter;

            $number = (int) (($number - $remainder - 1) / 26);
        }

        return $letter;
    }
}

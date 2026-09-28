<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductUnitModel;
use App\Models\QcInspectionModel;
use App\Models\QcChecklistItemModel;
use App\Models\QcDocumentationModel;

class ProductUnitController extends BaseController
{
    protected ProductUnitModel $productUnitModel;
    protected ProductModel $productModel;
    protected QcInspectionModel $qcInspectionModel;
    protected QcChecklistItemModel $qcChecklistItemModel;
    protected QcDocumentationModel $qcDocumentationModel;

    public function __construct()
    {
        $this->productUnitModel = new ProductUnitModel();
        $this->productModel = new ProductModel();
        $this->qcInspectionModel = new QcInspectionModel();
        $this->qcChecklistItemModel = new QcChecklistItemModel();
        $this->qcDocumentationModel = new QcDocumentationModel();
    }

    public function index()
    {
        $units = $this->productUnitModel
            ->select('product_units.*, products.name AS product_name, products.brand, products.model,
            EXISTS (
                SELECT 1
                FROM qc_inspections
                WHERE qc_inspections.product_unit_id = product_units.id
            ) AS has_inspection')

            ->join('products', 'products.id = product_units.product_id')
            ->orderBy('product_units.id', 'DESC')
            ->findAll();

        $inspections = $this->qcInspectionModel
            ->select('
                qc_inspections.*,
                users.name AS officer_name
            ')
            ->join('users', 'users.id = qc_inspections.user_id')
            ->orderBy('qc_inspections.inspection_date', 'DESC')
            ->orderBy('qc_inspections.id', 'DESC')
            ->findAll();

        $checklists = $this->qcChecklistItemModel
            ->orderBy('id', 'ASC')
            ->findAll();

        $documentations = $this->qcDocumentationModel
            ->orderBy('id', 'ASC')
            ->findAll();

        // Kelompokkan checklist berdasarkan pemeriksaan.

        $checklistByInspection = [];

        foreach ($checklists as $checklist) {
            $checklistByInspection[$checklist['qc_inspection_id']][] = $checklist;
        }


        // Kelompokkan dokumentasi berdasarkan pemeriksaan.

        $documentationByInspection = [];

        foreach ($documentations as $documentation) {
            $documentationByInspection[$documentation['qc_inspection_id']][] = $documentation;
        }

        // Gabungkan checklist dan dokumentasi ke masing-masing data pemeriksaan.

        foreach ($inspections as &$inspection) {

            $inspection['checklist'] =
                $checklistByInspection[$inspection['id']] ?? [];

            $inspection['documentations'] =
                $documentationByInspection[$inspection['id']] ?? [];
        }

        unset($inspection);

        // Kelompokkan pemeriksaan berdasarkan unit produk.

        $inspectionHistory = [];

        foreach ($inspections as $inspection) {
            $inspectionHistory[$inspection['product_unit_id']][] = $inspection;
        }

        return view('qc/product_units/index', [
            'units'            => $units,
            'products'         => $this->productModel
                ->orderBy('name', 'ASC')
                ->findAll(),
            'inspectionHistory' => $inspectionHistory,
        ]);
    }

    public function create()
    {
        $data = [
            'products' => $this->productModel
                ->orderBy('name', 'ASC')
                ->findAll(),
        ];

        return view('qc/product_units/create', $data);
    }

    public function store()
    {
        $data = [
            'product_id'    => $this->request->getPost('product_id'),
            'serial_number' => $this->request->getPost('serial_number'),
            'status'        => 'Menunggu QC',
        ];

        try {
            if (! $this->productUnitModel->insert($data)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $this->productUnitModel->errors());
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            if ($e->getCode() === 1062) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', ['serial_number' => 'Nomor serial sudah digunakan.']);
            }

            throw $e;
        }

        return redirect()
            ->to('/qc/product-units')
            ->with('success', 'Unit produk berhasil ditambahkan.');
    }

    public function inspect($id)
    {
        $unit = $this->productUnitModel
            ->select('product_units.*, products.name AS product_name, products.brand, products.model')
            ->join('products', 'products.id = product_units.product_id')
            ->where('product_units.id', $id)
            ->first();

        if (! $unit) {
            return redirect()
                ->to('/qc/product-units')
                ->with('error', 'Unit produk tidak ditemukan.');
        }

        return view('qc/product_units/inspect', [
            'unit' => $unit,
        ]);
    }

    public function detail($id)
    {
        $unit = $this->productUnitModel
            ->select('product_units.*, products.name AS product_name, products.brand, products.model')
            ->join('products', 'products.id = product_units.product_id')
            ->where('product_units.id', $id)
            ->first();

        if (!$unit) {
            return redirect()
                ->to(base_url('qc/product-units'))
                ->with('error', 'Unit produk tidak ditemukan.');
        }

        $inspections = $this->qcInspectionModel
            ->select('
            qc_inspections.*,
            users.name AS officer_name
        ')
            ->join('users', 'users.id = qc_inspections.user_id')
            ->where('qc_inspections.product_unit_id', $id)
            ->orderBy('qc_inspections.inspection_date', 'DESC')
            ->orderBy('qc_inspections.id', 'DESC')
            ->findAll();

        foreach ($inspections as &$inspection) {

            $inspection['checklist'] = $this->qcChecklistItemModel
                ->where('qc_inspection_id', $inspection['id'])
                ->orderBy('id', 'ASC')
                ->findAll();

            $inspection['documentations'] = $this->qcDocumentationModel
                ->where('qc_inspection_id', $inspection['id'])
                ->orderBy('id', 'ASC')
                ->findAll();
        }

        unset($inspection);

        return view('qc/product_units/detail', [
            'unit'        => $unit,
            'inspections' => $inspections,
        ]);
    }

    public function saveInspection($id)
    {
        $unitModel          = new ProductUnitModel();
        $inspectionModel    = new QcInspectionModel();
        $checklistModel     = new QcChecklistItemModel();
        $documentationModel = new QcDocumentationModel();

        $unit = $unitModel
            ->select('product_units.*, products.name AS product_name, products.brand, products.model')
            ->join('products', 'products.id = product_units.product_id')
            ->where('product_units.id', $id)
            ->first();

        if (!$unit) {
            return redirect()
                ->to(base_url('qc/product-units'))
                ->with('error', 'Unit produk tidak ditemukan.');
        }

        // Unit hanya boleh diperiksa ketika masih menunggu QC.

        if (!in_array($unit['status'], ['Menunggu QC', 'Perlu Pemeriksaan Ulang'], true)) {
            return redirect()
                ->to(base_url('qc/product-units'))
                ->with('error', 'Unit tersebut tidak dapat diperiksa kembali.');
        }

        $checklist = $this->request->getPost('checklist');
        $result    = $this->request->getPost('result');

        // Validasi server-side

        $validation = service('validation');

        $validation->setRules([
            'physical_condition' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Kondisi fisik wajib diisi.',
                    'max_length' => 'Kondisi fisik maksimal 100 karakter.',
                ],
            ],
            'completeness' => [
                'rules'  => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Kelengkapan wajib diisi.',
                    'max_length' => 'Kelengkapan maksimal 100 karakter.',
                ],
            ],
            'result' => [
                'rules'  => 'required|in_list[Lolos QC,Tidak Lolos QC,Perlu Pemeriksaan Ulang]',
                'errors' => [
                    'required' => 'Hasil QC wajib dipilih.',
                    'in_list'  => 'Hasil QC tidak valid.',
                ],
            ],
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Checklist wajib berjumlah 7 item.

        if (!is_array($checklist) || count($checklist) !== 7) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Checklist QC harus diisi lengkap.');
        }

        $checklistItems = [
            'Kemasan dalam kondisi baik',
            'Produk tidak lecet atau retak',
            'Nomor seri produk sesuai dengan kemasan',
            'Kelengkapan produk sesuai',
            'Produk dapat dinyalakan',
            'Fungsi dasar berjalan',
            'Tidak ditemukan kerusakan',
        ];

        foreach ($checklistItems as $index => $itemName) {

            if (
                !isset($checklist[$index]['result']) ||
                !in_array($checklist[$index]['result'], ['Ya', 'Tidak'], true)
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Checklist QC harus diisi lengkap.');
            }
        }

        //    File wajib

        $unboxingVideo = $this->request->getFile('unboxing_video');
        $serialPhoto   = $this->request->getFile('serial_photo');
        $productPhoto  = $this->request->getFile('product_photo');

        $files = [
            'unboxing_video' => $unboxingVideo,
            'serial_photo'   => $serialPhoto,
            'product_photo'  => $productPhoto,
        ];

        foreach ($files as $file) {

            if (!$file || !$file->isValid()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Semua dokumentasi QC wajib diunggah.');
            }
        }

        //    Validasi tipe file di server.

        if (
            !in_array($unboxingVideo->getMimeType(), [
                'video/mp4',
                'video/quicktime',
                'video/webm',
            ], true)
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Format video unboxing tidak valid.');
        }

        foreach ([$serialPhoto, $productPhoto] as $image) {

            if (!str_starts_with($image->getMimeType(), 'image/')) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Format foto dokumentasi tidak valid.');
            }
        }

        //    Direktori Penyimpanan

        $uploadPath = FCPATH . 'uploads/qc/' . $unit['id'];

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $savedFiles = [];

        $db = db_connect();

        $db->transStart();

        try {

            // Simpan Pemeriksaan QC

            $inspectionId = $inspectionModel->insert([
                'product_unit_id'   => $unit['id'],
                'user_id'           => session()->get('user_id'),
                'inspection_date'   => date('Y-m-d'),
                'physical_condition' => trim($this->request->getPost('physical_condition')),
                'completeness'      => trim($this->request->getPost('completeness')),
                'result'            => $result,
                'notes'             => trim((string) $this->request->getPost('notes')),
            ], true);

            if (!$inspectionId) {
                throw new \RuntimeException('Gagal menyimpan pemeriksaan QC.');
            }

            // Simpan 7 Checklist

            foreach ($checklistItems as $index => $itemName) {

                $checklistModel->insert([
                    'qc_inspection_id' => $inspectionId,
                    'item_name'        => $itemName,
                    'result'           => $checklist[$index]['result'],
                    'notes'            => null,
                ]);
            }

            // Simpan Dokumentasi file

            $documentationFiles = [
                [
                    'file' => $unboxingVideo,
                    'type' => 'unboxing_video',
                ],
                [
                    'file' => $serialPhoto,
                    'type' => 'serial_photo',
                ],
                [
                    'file' => $productPhoto,
                    'type' => 'product_photo',
                ],
            ];

            foreach ($documentationFiles as $documentation) {

                $file = $documentation['file'];

                $newName = $file->getRandomName();

                if (!$file->move($uploadPath, $newName)) {
                    throw new \RuntimeException('Gagal menyimpan file dokumentasi.');
                }

                $savedPath = 'uploads/qc/' . $unit['id'] . '/' . $newName;

                $savedFiles[] = FCPATH . $savedPath;

                $documentationModel->insert([
                    'qc_inspection_id' => $inspectionId,
                    'type'             => $documentation['type'],
                    'file_path'        => $savedPath,
                ]);
            }

            // Hasil QC menentukan status unit

            $statusMap = [
                'Lolos QC'                => 'Siap Dijual',
                'Tidak Lolos QC'          => 'Tidak Lolos QC',
                'Perlu Pemeriksaan Ulang' => 'Perlu Pemeriksaan Ulang',
            ];

            $unitModel->update($unit['id'], [
                'status' => $statusMap[$result],
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi pemeriksaan QC gagal.');
            }
        } catch (\Throwable $e) {

            foreach ($savedFiles as $savedFile) {

                if (is_file($savedFile)) {
                    unlink($savedFile);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->to(base_url('qc/product-units'))
            ->with('success', 'Pemeriksaan QC berhasil disimpan.');
    }
}

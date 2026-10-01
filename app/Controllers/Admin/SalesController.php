<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductUnitModel;
use App\Models\CustomerModel;
use App\Models\SalesModel;
use App\Services\ActivityLogService;
use CodeIgniter\Database\Exceptions\DatabaseException;

class SalesController extends BaseController
{
    protected ProductUnitModel $productUnitModel;
    protected CustomerModel $customerModel;
    protected SalesModel $salesModel;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->productUnitModel = new ProductUnitModel();
        $this->customerModel = new CustomerModel();
        $this->salesModel = new SalesModel();
        $this->activityLogService = new ActivityLogService();
    }

    public function index()
    {
        $units = $this->productUnitModel
            ->select('
                product_units.*,
                products.name AS product_name,
                products.brand,
                products.model
            ')
            ->join('products', 'products.id = product_units.product_id')
            ->where('product_units.status', 'Siap Dijual')
            ->orderBy('product_units.id', 'DESC')
            ->findAll();

        $customers = $this->customerModel
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('admin/sales/index', [
            'units' => $units,
            'customers' => $customers,
        ]);
    }

    public function store()
    {
        $unitId = $this->request->getPost('product_unit_id');
        $customerId = $this->request->getPost('customer_id');
        $purchaseReceipt = $this->request->getFile('purchase_receipt');

        $maxReceiptSize = 1 * 1024 * 1024;

        $allowedReceiptExtensions = [
            'jpg',
            'jpeg',
            'png',
            'pdf',
        ];

        $allowedReceiptMimeTypes = [
            'image/jpeg',
            'image/png',
            'application/pdf',
        ];

        $unit = $this->productUnitModel
            ->where('id', $unitId)
            ->where('status', 'Siap Dijual')
            ->first();

        if ($unit === null) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unit tidak tersedia untuk transaksi penjualan.');
        }

        $customer = $this->customerModel->find($customerId);

        if ($customer === null) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data pembeli tidak ditemukan.');
        }

        $existingSale = $this->salesModel
            ->where('product_unit_id', $unit['id'])
            ->first();

        if ($existingSale !== null) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Unit tersebut sudah memiliki transaksi penjualan dan tidak dapat dijual kembali.'
                );
        }

        if ($purchaseReceipt && $purchaseReceipt->getError() !== UPLOAD_ERR_NO_FILE) {

            if (!$purchaseReceipt->isValid()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Nota pembelian gagal diunggah.');
            }

            if ($purchaseReceipt->getError() !== UPLOAD_ERR_OK) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Upload nota pembelian gagal.');
            }

            $clientExtension = strtolower(
                ltrim($purchaseReceipt->getClientExtension(), '.')
            );

            $detectedExtension = strtolower(
                ltrim($purchaseReceipt->getExtension(), '.')
            );

            if (!in_array($clientExtension, $allowedReceiptExtensions, true)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Format nota pembelian tidak diizinkan.'
                    );
            }

            if (
                $detectedExtension === '' ||
                !in_array($detectedExtension, $allowedReceiptExtensions, true) ||
                $clientExtension !== $detectedExtension
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Extension nota pembelian tidak valid.'
                    );
            }

            $mimeType = $purchaseReceipt->getMimeType();

            if (!in_array($mimeType, $allowedReceiptMimeTypes, true)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Tipe file nota pembelian tidak valid.'
                    );
            }

            if ($purchaseReceipt->getSize() > $maxReceiptSize) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Nota pembelian melebihi ukuran maksimum 1 MB.'
                    );
            }

            $originalName = strtolower(
                $purchaseReceipt->getClientName()
            );

            if (
                preg_match(
                    '/\.(php|phtml|phar|php[0-9]?|cgi|pl|py|sh|exe|dll|bat|cmd)(\.|$)/',
                    $originalName
                )
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Nota pembelian memiliki nama file yang tidak aman.'
                    );
            }
        }

        $purchaseReceiptPath = null;

        if ($purchaseReceipt && $purchaseReceipt->isValid()) {
            $salesUploadPath = WRITEPATH . 'uploads/sales';

            if (!is_dir($salesUploadPath)) {
                mkdir($salesUploadPath, 0750, true);
            }

            $storedFileName = $purchaseReceipt->getRandomName();

            $purchaseReceiptPath = 'uploads/sales/' . $storedFileName;
        }

        $data = [
            'product_unit_id'           => $unit['id'],
            'customer_id'               => $customer['id'],
            'purchase_date'             => $this->request->getPost('purchase_date'),
            'invoice_number'            => trim((string) $this->request->getPost('invoice_number')),
            'purchase_location'         => trim((string) $this->request->getPost('purchase_location')),
            'marketplace_order_number'  => trim((string) $this->request->getPost('marketplace_order_number')),
            'warranty_duration'         => $this->request->getPost('warranty_duration'),
            'warranty_duration_unit'    => $this->request->getPost('warranty_duration_unit'),
            'warranty_start_date'       => $this->request->getPost('warranty_start_date'),
            'purchase_receipt_path'    => $purchaseReceiptPath,
            'notes'                     => trim((string) $this->request->getPost('notes')),
        ];

        if ($purchaseReceiptPath !== null) {
            $storedFileName = basename($purchaseReceiptPath);

            if (
                !$purchaseReceipt->move(
                    $salesUploadPath,
                    $storedFileName
                )
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Nota pembelian gagal disimpan.'
                    );
            }
        }

        try {
            $inserted = $this->salesModel->insert($data);
        } catch (DatabaseException $e) {
            if ($purchaseReceiptPath !== null) {
                $storedFilePath = WRITEPATH . $purchaseReceiptPath;

                if (is_file($storedFilePath)) {
                    unlink($storedFilePath);
                }
            }

            if ((int) $e->getCode() === 1062) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Unit tersebut sudah memiliki transaksi penjualan dan tidak dapat dijual kembali.'
                    );
            }

            throw $e;
        }

        if (!$inserted) {
            if ($purchaseReceiptPath !== null) {
                $storedFilePath = WRITEPATH . $purchaseReceiptPath;

                if (is_file($storedFilePath)) {
                    unlink($storedFilePath);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->salesModel->errors());
        }

        $this->activityLogService->log(
            'create',
            'Menyimpan transaksi penjualan untuk unit dengan ID ' . $unit['id'] . '.'
        );

        return redirect()
            ->to('/admin/sales')
            ->with('success', 'Transaksi penjualan berhasil disimpan.');
    }
}

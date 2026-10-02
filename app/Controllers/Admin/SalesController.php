<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductUnitModel;
use App\Models\CustomerModel;
use App\Models\SalesModel;
use App\Services\ActivityLogService;
use App\Services\WarrantyNumberService;
use App\Services\QrTokenService;
use CodeIgniter\Database\Exceptions\DatabaseException;
use App\Models\WarrantyModel;
use App\Services\QrCodeService;

class SalesController extends BaseController
{
    protected ProductUnitModel $productUnitModel;
    protected CustomerModel $customerModel;
    protected SalesModel $salesModel;
    protected ActivityLogService $activityLogService;
    protected WarrantyNumberService $warrantyNumberService;
    protected QrTokenService $qrTokenService;
    protected WarrantyModel $warrantyModel;

    public function __construct()
    {
        $this->productUnitModel = new ProductUnitModel();
        $this->customerModel = new CustomerModel();
        $this->salesModel = new SalesModel();
        $this->activityLogService = new ActivityLogService();
        $this->warrantyModel = new WarrantyModel();
        $this->warrantyNumberService = new WarrantyNumberService();
        $this->qrTokenService = new QrTokenService();
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
            ->join(
                'products',
                'products.id = product_units.product_id'
            )
            ->join(
                'sales',
                'sales.product_unit_id = product_units.id',
                'left'
            )
            ->where('product_units.status', 'Siap Dijual')
            ->where('sales.id', null)
            ->orderBy('product_units.id', 'DESC')
            ->findAll();

        $customers = $this->customerModel
            ->orderBy('name', 'ASC')
            ->findAll();

        $sales = $this->salesModel
            ->select('
                sales.id,
                sales.product_unit_id,
                sales.customer_id,
                sales.purchase_date,
                sales.invoice_number,
                sales.purchase_location,
                sales.marketplace_order_number,
                sales.warranty_duration,
                sales.warranty_duration_unit,
                sales.warranty_start_date AS sale_warranty_start_date,
                sales.purchase_receipt_path,
                sales.notes,
                sales.created_at,
                sales.updated_at,

                product_units.serial_number,
                product_units.status AS unit_status,

                products.name AS product_name,
                products.brand,
                products.model,

                customers.name AS customer_name,
                customers.whatsapp AS customer_whatsapp,
                customers.email AS customer_email,
                customers.address AS customer_address,

                warranties.warranty_number,
                warranties.start_date AS warranty_start_date,
                warranties.end_date AS warranty_end_date,
                warranties.status AS warranty_status,
                warranties.qr_token
            ')
            ->join(
                'product_units',
                'product_units.id = sales.product_unit_id'
            )
            ->join(
                'products',
                'products.id = product_units.product_id'
            )
            ->join(
                'customers',
                'customers.id = sales.customer_id'
            )
            ->join(
                'warranties',
                'warranties.sale_id = sales.id',
                'left'
            )
            ->orderBy('sales.id', 'DESC')
            ->findAll();

        $qrCodeService = new QrCodeService();

        foreach ($sales as &$sale) {
            if (!empty($sale['qr_token'])) {
                $sale['warranty_url'] = $qrCodeService->generateWarrantyUrl(
                    $sale['qr_token']
                );

                $sale['qr_code_svg'] = $qrCodeService->generateSvg(
                    $sale['warranty_url']
                );
            } else {
                $sale['warranty_url'] = null;
                $sale['qr_code_svg'] = null;
            }
        }

        unset($sale);

        return view('admin/sales/index', [
            'units' => $units,
            'customers' => $customers,
            'sales' => $sales,
        ]);
    }

    public function detail(int $saleId)
    {
        $sale = $this->salesModel
            ->select('
                sales.id,
                sales.product_unit_id,
                sales.customer_id,
                sales.purchase_date,
                sales.invoice_number,
                sales.purchase_location,
                sales.marketplace_order_number,
                sales.warranty_duration,
                sales.warranty_duration_unit,
                sales.warranty_start_date AS sale_warranty_start_date,
                sales.purchase_receipt_path,
                sales.notes,
                sales.created_at,
                sales.updated_at,

                product_units.serial_number,
                product_units.status AS unit_status,

                products.name AS product_name,
                products.brand,
                products.model,

                customers.name AS customer_name,
                customers.whatsapp AS customer_whatsapp,
                customers.email AS customer_email,
                customers.address AS customer_address,

                warranties.warranty_number,
                warranties.start_date AS warranty_start_date,
                warranties.end_date AS warranty_end_date,
                warranties.status AS warranty_status,
                warranties.qr_token
            ')
            ->join(
                'product_units',
                'product_units.id = sales.product_unit_id'
            )
            ->join(
                'products',
                'products.id = product_units.product_id'
            )
            ->join(
                'customers',
                'customers.id = sales.customer_id'
            )
            ->join(
                'warranties',
                'warranties.sale_id = sales.id',
                'left'
            )
            ->where('sales.id', $saleId)
            ->first();

        if ($sale === null) {
            return redirect()
                ->to('/admin/sales')
                ->with('error', 'Data transaksi penjualan tidak ditemukan.');
        }

        return view('admin/sales/detail', [
            'sale' => $sale,
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
        $salesUploadPath = WRITEPATH . 'uploads/sales';
        $storedFileName = null;

        if ($purchaseReceipt && $purchaseReceipt->isValid()) {

            if (!is_dir($salesUploadPath)) {
                mkdir($salesUploadPath, 0750, true);
            }

            $storedFileName = $purchaseReceipt->getRandomName();

            $purchaseReceiptPath = 'uploads/sales/' . $storedFileName;
        }

        $data = [
            'product_unit_id'          => $unit['id'],
            'customer_id'              => $customer['id'],
            'purchase_date'            => $this->request->getPost('purchase_date'),
            'invoice_number'           => trim(
                (string) $this->request->getPost('invoice_number')
            ),
            'purchase_location'        => trim(
                (string) $this->request->getPost('purchase_location')
            ),
            'marketplace_order_number' => trim(
                (string) $this->request->getPost('marketplace_order_number')
            ),
            'warranty_duration'        => $this->request->getPost('warranty_duration'),
            'warranty_duration_unit'   => $this->request->getPost('warranty_duration_unit'),
            'warranty_start_date'      => $this->request->getPost('warranty_start_date'),
            'purchase_receipt_path'    => $purchaseReceiptPath,
            'notes'                    => trim(
                (string) $this->request->getPost('notes')
            ),
        ];

        $duration = (int) $data['warranty_duration'];
        $durationUnit = $data['warranty_duration_unit'];
        $startDate = $data['warranty_start_date'];

        if ($duration <= 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Durasi garansi tidak valid.');
        }

        if (!in_array($durationUnit, ['Bulan', 'Tahun'], true)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Satuan durasi garansi tidak valid.');
        }

        $startDateObject = \DateTimeImmutable::createFromFormat(
            'Y-m-d',
            $startDate
        );

        $dateErrors = \DateTimeImmutable::getLastErrors();

        if (
            $startDateObject === false ||
            (
                is_array($dateErrors) &&
                (
                    $dateErrors['warning_count'] > 0 ||
                    $dateErrors['error_count'] > 0
                )
            )
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Tanggal mulai garansi tidak valid.');
        }

        $intervalUnit = match ($durationUnit) {
            'Bulan' => 'month',
            'Tahun' => 'year',
            default => null,
        };

        if ($intervalUnit === null) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Satuan durasi garansi tidak valid.');
        }

        $interval = $duration . ' ' . $intervalUnit;

        $endDateObject = $startDateObject->modify('+' . $interval);

        if ($endDateObject === false) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tanggal berakhir garansi gagal dihitung.'
                );
        }

        $endDate = $endDateObject->format('Y-m-d');
        $year = $startDateObject->format('Y');

        if ($purchaseReceiptPath !== null) {

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

        $db = \Config\Database::connect();

        $saleId = null;
        $warrantyNumber = null;

        try {
            $db->transBegin();

            $saleId = $this->salesModel->insert($data);

            if (!$saleId) {
                throw new \RuntimeException(
                    'Transaksi penjualan gagal disimpan.'
                );
            }

            $warrantyNumber = $this->warrantyNumberService
                ->generate($year);

            $qrToken = $this->qrTokenService
                ->generate();

            $insertedWarranty = $this->warrantyModel->insert([
                'sale_id'        => $saleId,
                'warranty_number' => $warrantyNumber,
                'start_date'     => $startDate,
                'end_date'       => $endDate,
                'status'         => 'Garansi Aktif',
                'qr_token'       => $qrToken,
            ]);

            if (!$insertedWarranty) {
                throw new \RuntimeException(
                    'Data garansi gagal disimpan.'
                );
            }

            $updatedUnit = $this->productUnitModel->update(
                $unit['id'],
                [
                    'status' => 'Terjual',
                ]
            );

            if (!$updatedUnit) {
                throw new \RuntimeException(
                    'Status unit gagal diperbarui.'
                );
            }

            if (!$db->transStatus()) {
                throw new \RuntimeException(
                    'Transaksi penjualan dan aktivasi garansi gagal.'
                );
            }

            $db->transCommit();
        } catch (DatabaseException $e) {

            $db->transRollback();

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
                        'Unit, nomor garansi, atau QR token sudah digunakan.'
                    );
            }

            log_message(
                'error',
                'Transaksi dan aktivasi garansi gagal: ' .
                    $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Transaksi dan aktivasi garansi gagal. Tidak ada perubahan data yang disimpan.'
                );
        } catch (\Throwable $e) {

            $db->transRollback();

            if ($purchaseReceiptPath !== null) {
                $storedFilePath = WRITEPATH . $purchaseReceiptPath;

                if (is_file($storedFilePath)) {
                    unlink($storedFilePath);
                }
            }

            log_message(
                'error',
                'Transaksi dan aktivasi garansi gagal: ' .
                    $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Transaksi dan aktivasi garansi gagal. Tidak ada perubahan data yang disimpan.'
                );
        }

        $this->activityLogService->log(
            'create',
            'Menyimpan transaksi penjualan dan mengaktifkan garansi untuk unit dengan ID ' .
                $unit['id'] .
                ' dengan nomor garansi ' .
                $warrantyNumber .
                '.'
        );

        return redirect()
            ->to('/admin/sales')
            ->with(
                'success',
                'Transaksi berhasil disimpan dan garansi berhasil diaktifkan dengan nomor ' .
                    $warrantyNumber .
                    '.'
            );
    }
}

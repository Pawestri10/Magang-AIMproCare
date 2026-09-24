<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductUnitModel;

class ProductUnitController extends BaseController
{
    protected ProductUnitModel $productUnitModel;
    protected ProductModel $productModel;

    public function __construct()
    {
        $this->productUnitModel = new ProductUnitModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'units' => $this->productUnitModel
                ->select('product_units.*, products.name AS product_name, products.brand, products.model')
                ->join('products', 'products.id = product_units.product_id')
                ->orderBy('product_units.id', 'DESC')
                ->findAll(),
        ];

        return view('qc/product_units/index', $data);
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
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductUnitModel;

class SalesController extends BaseController
{
    protected ProductUnitModel $productUnitModel;

    public function __construct()
    {
        $this->productUnitModel = new ProductUnitModel();
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

        return view('admin/sales/index', [
            'units' => $units,
        ]);
    }
}

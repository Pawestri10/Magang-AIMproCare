<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected ProductModel $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'products' => $this->productModel
                ->orderBy('id', 'DESC')
                ->findAll(),
        ];

        return view('admin/products/index', $data);
    }

    public function create()
    {
        return view('admin/products/create');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);

        if ($product === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Produk tidak ditemukan.'
            );
        }

        return view('admin/products/edit', [
            'product' => $product,
        ]);
    }

    public function update($id)
    {
        $product = $this->productModel->find($id);

        if ($product === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Produk tidak ditemukan.'
            );
        }

        $data = [
            'name'  => $this->request->getPost('name'),
            'brand' => $this->request->getPost('brand'),
            'model' => $this->request->getPost('model'),
        ];

        if (! $this->productModel->update($id, $data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->productModel->errors());
        }

        return redirect()
            ->to('/admin/products')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);

        if ($product === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Produk tidak ditemukan.'
            );
        }

        $this->productModel->delete($id);

        return redirect()
            ->to('/admin/products')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function store()
    {
        $data = [
            'name'  => $this->request->getPost('name'),
            'brand' => $this->request->getPost('brand'),
            'model' => $this->request->getPost('model'),
        ];

        if (!$this->productModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->productModel->errors());
        }

        return redirect()->to('admin/products')->with('success', 'Produk berhasil ditambahkan.');
    }
}

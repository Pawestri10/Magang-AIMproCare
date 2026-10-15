<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Services\ActivityLogService;

class ProductController extends BaseController
{
    protected ProductModel $productModel;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->activityLogService = new ActivityLogService();
    }


    public function index()
    {
        $search = trim((string) $this->request->getGet('search'));
        $filter = (string) $this->request->getGet('filter');

        $allowedFilters = ['all', 'name', 'brand', 'model'];

        if (! in_array($filter, $allowedFilters, true)) {
            $filter = 'all';
        }

        $builder = $this->productModel
            ->orderBy('id', 'DESC');

        if ($search !== '') {
            switch ($filter) {
                case 'name':
                    $builder->like('name', $search);
                    break;
                case 'brand':
                    $builder->like('brand', $search);
                    break;
                case 'model':
                    $builder->like('model', $search);
                    break;
                default:
                    $builder->groupStart()->like('name', $search)->orLike('brand', $search)->orLike('model', $search)->groupEnd();
                    break;
            }
        }

        $products = $builder->paginate(10, 'default');

        $pager = $this->productModel->pager;

        $pager->only(['search', 'filter']);

        $data = [
            'products' => $products,
            'pager' => $pager,
            'totalProducts' => $pager->getTotal('default'),
            'perPage' => 10,
            'search' => $search,
            'filter' => $filter,
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

        $this->activityLogService->log(
            'UPDATE',
            'Administrator memperbarui produk ' . $data['name'] . '.'
        );

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

        if (! $this->productModel->delete($id)) {
            return redirect()
                ->back()
                ->with('error', 'Produk gagal dihapus.');
        }

        $this->activityLogService->log(
            'DELETE',
            'Administrator menghapus produk ' . $product['name'] . '.'
        );

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

        $this->activityLogService->log('CREATE', 'Administrator menambahkan produk ' . $data['name'] . '.');

        return redirect()->to('admin/products')->with('success', 'Produk berhasil ditambahkan.');
    }
}

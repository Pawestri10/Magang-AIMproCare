<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Services\ActivityLogService;

class CustomerController extends BaseController
{
    protected CustomerModel $customerModel;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->activityLogService = new ActivityLogService();
    }

    public function index()
    {
        $customers = $this->customerModel
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('admin/customers/index', [
            'customers' => $customers,
        ]);
    }

    public function create()
    {
        return view('admin/customers/create');
    }

    public function store()
    {
        $data = [
            'name'    => $this->request->getPost('name'),
            'whatsapp' => $this->request->getPost('whatsapp'),
            'email'   => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
        ];

        if (!$this->customerModel->insert($data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->customerModel->errors());
        }

        $customerId = $this->customerModel->getInsertID();

        $this->activityLogService->log(
            'CREATE_CUSTOMER',
            'Menambahkan data pembeli ID ' . $customerId . '.'
        );

        return redirect()
            ->to('/admin/customers')
            ->with('success', 'Data pembeli berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $customer = $this->customerModel->find($id);

        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data pembeli tidak ditemukan.'
            );
        }

        return view('admin/customers/edit', [
            'customer' => $customer,
        ]);
    }

    public function update($id)
    {
        $customer = $this->customerModel->find($id);

        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data pembeli tidak ditemukan.'
            );
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'whatsapp' => $this->request->getPost('whatsapp'),
            'email'    => $this->request->getPost('email'),
            'address'  => $this->request->getPost('address'),
        ];

        if (!$this->customerModel->update($id, $data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->customerModel->errors());
        }

        $this->activityLogService->log(
            'UPDATE_CUSTOMER',
            'Memperbarui data pembeli ID ' . $id . '.'
        );

        return redirect()
            ->to('/admin/customers')
            ->with('success', 'Data pembeli berhasil diperbarui.');
    }

    public function delete($id)
    {
        $customer = $this->customerModel->find($id);

        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data pembeli tidak ditemukan.'
            );
        }

        $this->customerModel->delete($id);

        $this->activityLogService->log(
            'DELETE_CUSTOMER',
            'Menghapus data pembeli ID ' . $id . '.'
        );

        return redirect()
            ->to('/admin/customers')
            ->with('success', 'Data pembeli berhasil dihapus.');
    }
}
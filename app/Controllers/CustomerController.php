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

        $search = trim((string) $this->request->getGet('search'));
        $filter = (string) $this->request->getGet('filter');

        $allowedFilters = [
            'all',
            'name',
            'whatsapp',
            'email',
            'address',
        ];

        if (!in_array($filter, $allowedFilters, true)) {
            $filter = 'all';
        }

        $builder = $this->customerModel
            ->orderBy('id', 'DESC');

        if ($search !== '') {
            switch ($filter) {
                case 'name':
                    $builder->like('name', $search);
                    break;

                case 'whatsapp':
                    $builder->like('whatsapp', $search);
                    break;

                case 'email':
                    $builder->like('email', $search);
                    break;

                case 'address':
                    $builder->like('address', $search);
                    break;

                default:
                    $builder->groupStart()
                        ->like('name', $search)
                        ->orLike('whatsapp', $search)
                        ->orLike('email', $search)
                        ->orLike('address', $search)
                        ->groupEnd();
                    break;
            }
        }

        $customers = $builder->paginate(10, 'default');

        $pager = $this->customerModel->pager;

        $pager->only(['search', 'filter']);

        $data = [
            'customers' => $customers,
            'pager' => $pager,
            'totalCustomers' => $pager->getTotal('default'),
            'perPage' => 10,
            'search' => $search,
            'filter' => $filter,
        ];

        return view('admin/customers/index', $data);
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

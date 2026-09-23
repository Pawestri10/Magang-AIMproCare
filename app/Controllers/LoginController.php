<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function admin()
    {

        if ($this->request->getMethod() === 'POST') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();

            $user = $userModel->where('email', $email)->first();

            if (!$user || !password_verify($password, $user['password'])) {
                return redirect()->back()->with('error', 'Email atau password salah.');
            }

            if ($user['role'] !== 'Administrator') {
                return redirect()->back()->with('error', 'Email atau password salah.');
            }

            session()->regenerate();

            session()->set([
                'user_id'    => $user['id'],
                'name'       => $user['name'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/admin/dashboard');
        }

        return view('auth/login', [
            'role' => 'Administrator',
        ]);
    }

    public function qc()
    {
        if ($this->request->getMethod() === 'POST') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();

            $user = $userModel->where('email', $email)->first();

            if (!$user || !password_verify($password, $user['password'])) {
                return redirect()->back()->with('error', 'Email atau password salah.');
            }

            if ($user['role'] !== 'Petugas QC') {
                return redirect()->back()->with('error', 'Email atau password salah.');
            }

            session()->regenerate();

            session()->set([
                'user_id'    => $user['id'],
                'name'       => $user['name'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/qc/dashboard');
        }

        return view('auth/login', [
            'role' => 'Petugas QC',
        ]);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}

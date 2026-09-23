<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('isLoggedIn')) {
            $uri = $request->getUri()->getPath();

            if (str_starts_with($uri, '/qc/')) {
                return redirect()->to('/login-hanyaqc');
            }

            return redirect()->to('/login-hanyaadmin');
        }

        $role = session()->get('role');

        if ($arguments !== null && ! in_array($role, $arguments, true)) {
            return redirect()->to('/');
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak ada tindakan setelah request.
    }
}

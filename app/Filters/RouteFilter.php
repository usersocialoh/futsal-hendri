<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RouteFilter implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null)
    {
        helper('url');
        $session = \Config\Services::session();
        $userId = $session->get('user_id');

        $currentRoute = uri_string();
        $currentRoute = explode('/', $currentRoute)[0];
        if ($currentRoute =='login'  || $currentRoute == 'register' ||
            $currentRoute == 'reset-password' || $currentRoute == 'forgot-password') {
            if ($userId) {
                return redirect()->to('/profile');
            }
        } else {
            if (!$userId) {
                return redirect()->to('/login');
            }
        }
        // TODO: Implement before() method.
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}

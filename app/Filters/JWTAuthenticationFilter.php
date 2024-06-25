<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;

class JWTAuthenticationFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = getenv('JWT_SECRET_KEY');
        $authHeader = $request->getHeader("Authorization");

        if ($authHeader == null) {
            return Services::response()
                ->setJSON(['status' => 'error', 'message' => 'Authorization header missing'])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }

        $token = $authHeader->getValue();
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // data pengguna yang diambil dari token
            $request->pengguna    = $decoded->pengguna;
            $request->id_pengguna = $decoded->id;
            
        } catch (\Exception $e) {
            return Services::response()
                ->setJSON(['status' => 'error', 'message' => 'Invalid or expired token' . $e->getMessage()])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing required
    }
}

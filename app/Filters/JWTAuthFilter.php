<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\JWTAuth;

class JWTAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getServer('HTTP_AUTHORIZATION');

        if (!$authHeader) {
            return response()->setJSON(['message' => 'Token no proporcionado'])->setStatusCode(401);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        if (!JWTAuth::validateToken($token)) {
            return response()->setJSON(['message' => 'Token inválido o expirado'])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita hacer nada después de la ejecución
    }
}

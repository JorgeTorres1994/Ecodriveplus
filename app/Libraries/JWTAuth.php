<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth
{
    private static $secret_key = ";O)AqpGF)019"; // Cámbiala en producción
    private static $encrypt = ['HS256'];
    private static $aud = null;

    public static function createToken($data)
    {
        $time = time();
        $token = [
            'iat' => $time, // Tiempo de creación
            'exp' => $time + (60 * 60), // Expira en 1 hora
            'data' => $data
        ];

        return JWT::encode($token, self::$secret_key, 'HS256');
    }

    public static function validateToken($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, new Key(self::$secret_key, 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            return false;
        }
    }
}

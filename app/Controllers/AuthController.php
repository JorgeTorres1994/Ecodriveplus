<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;
use App\Libraries\JWTAuth;

class AuthController extends Controller
{
    public function loginForm()
    {
        // Si ya está autenticado, lo redirige al dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/login');
    }

    public function login()
    {
        $model = new UsuarioModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // 🔹 Regenerar la sesión para evitar problemas con sesiones previas
            session()->destroy(); // Elimina cualquier sesión anterior
            session()->start(); // Inicia una nueva sesión limpia
            session()->regenerate(); // Regenera el ID de sesión para mayor seguridad

            // Crear Token JWT
            $token = JWTAuth::createToken([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['rol'],
            ]);

            // 🔹 Guardar los datos de sesión correctamente
            session()->set([
                'user_id' => $user['id'],
                'user_email' => $user['email'],
                'user_role' => $user['rol'],
                'logged_in' => true,
                'jwt_token' => $token
            ]);

            // 🔹 Si la petición es AJAX, retornar JSON con la URL de redirección
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'redirect' => base_url('/admin/dashboard')
                ]);
            }

            return redirect()->to('/admin/dashboard');
        } else {
            // ⚠️ Si es AJAX, retorna JSON de error
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Usuario o contraseña incorrectos'
                ])->setStatusCode(401);
            }

            session()->setFlashdata('error', 'Usuario o contraseña incorrectos');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'Sesión cerrada correctamente');
    }
}

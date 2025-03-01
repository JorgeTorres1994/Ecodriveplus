<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('admin/login');
    }

    public function login()
    {
        $session = session();
        $model = new UsuarioModel();
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'user_email' => $user['email'],
                'logged_in' => true
            ]);
            return redirect()->to('/admin/dashboard');
        } else {
            $session->setFlashdata('error', 'Credenciales incorrectas');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}

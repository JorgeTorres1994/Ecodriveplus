<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class UsuarioController extends Controller
{
public function usuarios()
    {
        $usuarioModel = new UsuarioModel();
        $usuarios_admin = $usuarioModel->findAll(); // Obtener todos los usuarios

        // Verificar si la petición es JSON o vista
        if ($this->request->isAJAX() || strpos($this->request->getHeaderLine('Accept'), 'application/json') !== false) {
            return $this->response->setStatusCode(200)->setJSON($usuarios_admin);
        }

        return view('admin/usuarios_list', [
            'title' => "Gestión de Administradores",
            'usuarios_admin' => $usuarios_admin
        ]);
    }

    public function nuevoUsuario()
    {
        return view('admin/usuarios_form', ['title' => 'Agregar Administrador']);
    }

    public function guardarUsuario()
    {
        $usuarioModel = new UsuarioModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'rol' => $this->request->getPost('rol')
        ];

        $usuarioModel->insert($data);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(201)->setJSON(['message' => 'Administrador agregado exitosamente']);
        }

        return redirect()->to('/admin/usuarios')->with('success', 'Administrador agregado exitosamente');
    }

    public function editarUsuario($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuario_admin = $usuarioModel->find($id);

        if (!$usuario_admin) {
            return redirect()->to('/admin/usuarios')->with('error', 'El usuario no existe.');
        }

        return view('admin/usuarios_edit', [
            'title' => 'Editar Administrador',
            'usuario_admin' => $usuario_admin
        ]);
    }

    public function actualizarUsuario($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuario_admin = $usuarioModel->find($id);

        if (!$usuario_admin) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'El usuario no existe.']);
        }

        $updateData = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'rol' => $this->request->getPost('rol')
        ];

        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $usuarioModel->update($id, $updateData);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Administrador actualizado exitosamente']);
        }

        return redirect()->to('/admin/usuarios')->with('success', 'Administrador actualizado exitosamente');
    }

    public function eliminarUsuario($id)
    {
        $usuarioModel = new UsuarioModel();

        if (!$usuarioModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'El administrador no existe.']);
        }

        $usuarioModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Administrador eliminado exitosamente']);
        }

        return redirect()->to('/admin/usuarios')->with('success', 'Administrador eliminado exitosamente.');
    }
}
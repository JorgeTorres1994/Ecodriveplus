<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PremioModel;

class PremiosController extends Controller
{
    public function premios(){    
    $premioModel = new PremioModel();
        $premios = $premioModel->getAllPremios(); // 🔥 Solo los datos

        // Retornar JSON si la solicitud es AJAX o se solicita JSON explícitamente
        if ($this->request->isAJAX() || strpos($this->request->getHeaderLine('Accept'), 'application/json') !== false) {
            return $this->response->setStatusCode(200)->setJSON($premios);
        }

        // Retornar la vista con los premios
        return view('admin/premios_list', ['title' => "Gestión de Premios", 'premios' => $premios]);
    }

    public function nuevoPremio()
    {
        return view('admin/premios_form', ['title' => 'Agregar Premio']);
    }

    public function guardarPremio()
    {
        $premioModel = new PremioModel();
        $imagen = $this->request->getFile('imagen');
        $nombreImagen = null;

        // Manejo de la imagen
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move('uploads/premios', $nombreImagen);
        }

        // Insertar en la base de datos
        $premioModel->insert([
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'tipo' => $this->request->getPost('tipo'),
            'dia' => $this->request->getPost('dia'),
            'imagen' => $nombreImagen ? 'uploads/premios/' . $nombreImagen : null
        ]);

        // Retornar JSON si es una API o redirigir si es vista
        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(201)->setJSON(['message' => 'Premio agregado exitosamente']);
        }

        return redirect()->to('/admin/premios')->with('success', 'Premio agregado exitosamente');
    }

    public function editarPremio($id)
    {
        $premioModel = new PremioModel();
        $premio = $premioModel->getPremioById($id);

        // Si es API, devolver JSON
        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON($premio);
        }

        return view('admin/premios_edit', ['premio' => $premio]);
    }

    public function actualizarPremio($id)
    {
        $premioModel = new PremioModel();
        $imagen = $this->request->getFile('imagen');
        $premioActual = $premioModel->getPremioById($id);

        $updateData = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'tipo' => $this->request->getPost('tipo'),
            'dia' => $this->request->getPost('dia'),
        ];

        // Manejo de imagen
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            if (!empty($premioActual['imagen']) && file_exists(FCPATH . $premioActual['imagen'])) {
                unlink(FCPATH . $premioActual['imagen']);
            }

            $nombreImagen = $imagen->getRandomName();
            $imagen->move(FCPATH . 'uploads/premios', $nombreImagen);
            $updateData['imagen'] = 'uploads/premios/' . $nombreImagen;
        }

        // Actualizar en la base de datos
        $premioModel->update($id, $updateData);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Premio actualizado exitosamente']);
        }

        return redirect()->to('/admin/premios')->with('success', 'Premio actualizado exitosamente');
    }

    public function eliminarPremio($id)
    {
        $premioModel = new PremioModel();
        $premio = $premioModel->getPremioById($id);

        if (!$premio) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'El premio no existe.']);
        }

        if (!empty($premio['imagen']) && file_exists(FCPATH . $premio['imagen'])) {
            unlink(FCPATH . $premio['imagen']);
        }

        $premioModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Premio eliminado exitosamente']);
        }

        return redirect()->to('/admin/premios')->with('success', 'Premio eliminado exitosamente.');
    }
}
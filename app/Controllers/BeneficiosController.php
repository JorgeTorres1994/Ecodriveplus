<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BeneficioModel;

class BeneficiosController extends Controller
{
    public function beneficios()
    {
        $beneficioModel = new BeneficioModel();
        $beneficios = $beneficioModel->getAllBeneficios();

        if ($this->request->isAJAX() || strpos($this->request->getHeaderLine('Accept'), 'application/json') !== false) {
            return $this->response->setStatusCode(200)->setJSON($beneficios);
        }

        return view('admin/beneficios_list', ['title' => "Gestión de Beneficios", 'beneficios' => $beneficios]);
    }

    public function nuevoBeneficio()
    {
        return view('admin/beneficios_form', ['title' => 'Agregar Beneficio']);
    }

    public function guardarBeneficio()
    {
        $beneficioModel = new BeneficioModel();
        $imagen = $this->request->getFile('imagen');
        $nombreImagen = null;

        // Manejo de la imagen
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move('uploads/beneficios', $nombreImagen);
        }

        // Verificar si la columna `imagen` permite NULL en la base de datos
        $beneficioModel->insert([
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'sede' => $this->request->getPost('sede'),
            'dias' => $this->request->getPost('dias'),
            'imagen' => $nombreImagen ? 'uploads/beneficios/' . $nombreImagen : '' // Usar cadena vacía si no hay imagen
        ]);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(201)->setJSON(['message' => 'Beneficio agregado exitosamente']);
        }

        return redirect()->to('/admin/beneficios')->with('success', 'Beneficio agregado exitosamente');
    }


    public function editarBeneficio($id)
    {
        $beneficioModel = new BeneficioModel();
        $beneficio = $beneficioModel->getBeneficioById($id);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON($beneficio);
        }

        return view('admin/beneficios_edit', ['beneficio' => $beneficio]);
    }

    public function actualizarBeneficio($id)
    {
        $beneficioModel = new BeneficioModel();
        $imagen = $this->request->getFile('imagen');
        $beneficioActual = $beneficioModel->getBeneficioById($id);

        $updateData = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'sede' => $this->request->getPost('sede'),
            'dias' => $this->request->getPost('dias'),
        ];

        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            if (!empty($beneficioActual['imagen']) && file_exists(FCPATH . $beneficioActual['imagen'])) {
                unlink(FCPATH . $beneficioActual['imagen']);
            }

            $nombreImagen = $imagen->getRandomName();
            $imagen->move(FCPATH . 'uploads/beneficios', $nombreImagen);
            $updateData['imagen'] = 'uploads/beneficios/' . $nombreImagen;
        }

        $beneficioModel->update($id, $updateData);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Beneficio actualizado exitosamente']);
        }

        return redirect()->to('/admin/beneficios')->with('success', 'Beneficio actualizado exitosamente');
    }

    public function eliminarBeneficio($id)
    {
        $beneficioModel = new BeneficioModel();
        $beneficio = $beneficioModel->getBeneficioById($id);

        if (!$beneficio) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'El beneficio no existe.']);
        }

        if (!empty($beneficio['imagen']) && file_exists(FCPATH . $beneficio['imagen'])) {
            unlink(FCPATH . $beneficio['imagen']);
        }

        $beneficioModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Beneficio eliminado exitosamente']);
        }

        return redirect()->to('/admin/beneficios')->with('success', 'Beneficio eliminado exitosamente.');
    }
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MultimediaModel;

class MultimediaController extends Controller
{
    public function multimedia()
    {
        $multimediaModel = new MultimediaModel();
        $multimedia = $multimediaModel->getAllMultimedia();

        // Retornar JSON si la solicitud es AJAX o si se solicita JSON explícitamente
        if ($this->request->isAJAX() || strpos($this->request->getHeaderLine('Accept'), 'application/json') !== false) {
            return $this->response->setStatusCode(200)->setJSON($multimedia);
        }

        // Retornar la vista con los datos de multimedia
        return view('admin/multimedia_list', ['title' => "Gestión de Multimedia", 'multimedia' => $multimedia]);
    }

    public function nuevoMultimedia()
    {
        return view('admin/multimedia_form', ['title' => 'Agregar Multimedia']);
    }

    public function guardarMultimedia()
    {
        $multimediaModel = new MultimediaModel();
        $imagen = $this->request->getFile('imagen');
        $nombreImagen = null;

        // Manejo de la imagen
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move('uploads/multimedia', $nombreImagen);
        }

        // Insertar en la base de datos
        $multimediaModel->insert([
            'titulo' => $this->request->getPost('titulo'),
            'subtitulo' => $this->request->getPost('subtitulo'),
            'detalle' => $this->request->getPost('detalle'),
            'nota' => $this->request->getPost('nota'),
            'fecha' => $this->request->getPost('fecha'),
            'imagen' => $nombreImagen ? 'uploads/multimedia/' . $nombreImagen : null
        ]);

        // Retornar JSON si es una API o redirigir si es vista
        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(201)->setJSON(['message' => 'Multimedia agregado exitosamente']);
        }

        return redirect()->to('/admin/multimedia')->with('success', 'Multimedia agregado exitosamente');
    }

    public function editarMultimedia($id)
    {
        $multimediaModel = new MultimediaModel();
        $multimedia = $multimediaModel->getMultimediaById($id);

        // Si es API, devolver JSON
        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON($multimedia);
        }

        return view('admin/multimedia_edit', ['multimedia' => $multimedia]);
    }

    public function actualizarMultimedia($id)
    {
        $multimediaModel = new MultimediaModel();
        $imagen = $this->request->getFile('imagen');
        $multimediaActual = $multimediaModel->getMultimediaById($id);

        $updateData = [
            'titulo' => $this->request->getPost('titulo'),
            'subtitulo' => $this->request->getPost('subtitulo'),
            'detalle' => $this->request->getPost('detalle'),
            'nota' => $this->request->getPost('nota'),
            'fecha' => $this->request->getPost('fecha')
        ];

        // Manejo de imagen
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            if (!empty($multimediaActual['imagen']) && file_exists(FCPATH . $multimediaActual['imagen'])) {
                unlink(FCPATH . $multimediaActual['imagen']);
            }

            $nombreImagen = $imagen->getRandomName();
            $imagen->move('uploads/multimedia', $nombreImagen);
            $updateData['imagen'] = 'uploads/multimedia/' . $nombreImagen;
        }

        // Actualizar en la base de datos
        $multimediaModel->update($id, $updateData);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Multimedia actualizado exitosamente']);
        }

        return redirect()->to('/admin/multimedia')->with('success', 'Multimedia actualizado exitosamente');
    }

    public function eliminarMultimedia($id)
    {
        $multimediaModel = new MultimediaModel();
        $multimedia = $multimediaModel->getMultimediaById($id);

        if (!$multimedia) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'El registro no existe.']);
        }

        if (!empty($multimedia['imagen']) && file_exists(FCPATH . $multimedia['imagen'])) {
            unlink(FCPATH . $multimedia['imagen']);
        }

        $multimediaModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Multimedia eliminado exitosamente']);
        }

        return redirect()->to('/admin/multimedia')->with('success', 'Multimedia eliminado exitosamente.');
    }
}

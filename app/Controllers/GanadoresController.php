<?php

namespace App\Controllers;

use App\Models\GanadoresModel;
use CodeIgniter\Controller;

class GanadoresController extends Controller
{
    public function index()
    {
        $model = new GanadoresModel();
        $ganadores = $model->obtenerGanadores(); // Obtener ganadores desde el modelo

        // Si la solicitud es AJAX o se solicita JSON explícitamente, devolver JSON
        if ($this->request->isAJAX() || $this->request->getHeaderLine('Accept') === 'application/json') {
            return $this->response->setStatusCode(200)->setJSON(['data' => $ganadores]);
        }

        // Si no es una API, retornar la vista
        return view('ganadores_list', ['ganadores' => $ganadores]);
    }
}

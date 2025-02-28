<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ParticipanteModel;

class ParticipanteController extends Controller
{
    public function importarExcel()
    {
        helper(['form', 'url']);
        log_message('debug', 'Inicio del proceso de importación de Excel');

        $file = $this->request->getFile('file');

        if (!$file->isValid()) {
            log_message('error', 'Archivo no válido: ' . $file->getErrorString());
            return redirect()->to('/admin/participantes')->with('error', 'Error en el archivo.');
        }

        $filePath = WRITEPATH . 'uploads/' . $file->store();
        log_message('debug', 'Archivo guardado en: ' . $filePath);

        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
            log_message('debug', 'Archivo Excel cargado correctamente');

            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            log_message('debug', 'Datos extraídos del archivo Excel: ' . print_r($data, true));

            $model = new ParticipanteModel();
            $insertedCount = 0;
            $duplicatedCount = 0;

            foreach ($data as $index => $row) {
                if ($index == 0) continue; // Saltar encabezados

                $dni = isset($row[1]) ? trim($row[1]) : null;

                if (!$dni) {
                    log_message('error', 'DNI vacío, se omite el registro: ' . print_r($row, true));
                    continue;
                }

                // Verificar si el DNI ya existe en la base de datos
                $existing = $model->where('dni', $dni)->first();
                if ($existing) {
                    log_message('warning', 'DNI duplicado detectado: ' . $dni);
                    $duplicatedCount++;
                    continue;
                }

                // Insertar solo si no existe
                $insertData = [
                    'nombre_completo' => isset($row[0]) ? trim($row[0]) : '',
                    'dni' => $dni,
                    'numero' => isset($row[2]) ? trim($row[2]) : '',
                    'tipo' => isset($row[3]) ? trim($row[3]) : '',
                    'correo' => isset($row[4]) ? trim($row[4]) : '',
                    'puntaje' => isset($row[5]) ? intval($row[5]) : 0
                ];

                log_message('debug', 'Insertando datos: ' . print_r($insertData, true));
                $model->insert($insertData);
                $insertedCount++;
            }

            log_message('debug', "Total de registros insertados: $insertedCount, Duplicados: $duplicatedCount");
            return redirect()->to('/admin/participantes')->with('success', "Importación finalizada. $insertedCount registros insertados, $duplicatedCount duplicados omitidos.");
        } catch (\Exception $e) {
            log_message('error', 'Error al procesar el archivo Excel: ' . $e->getMessage());
            return redirect()->to('/admin/participantes')->with('error', 'Error al procesar el archivo.');
        }
    }


    public function participantes()
    {
        $participanteModel = new ParticipanteModel();
        $participantes = $participanteModel->getAllParticipantes();

        // Retornar JSON si la solicitud es AJAX o se solicita JSON explícitamente
        if ($this->request->isAJAX() || strpos($this->request->getHeaderLine('Accept'), 'application/json') !== false) {
            return $this->response->setStatusCode(200)->setJSON($participantes);
        }

        return view('admin/participantes_list', ['title' => "Gestión de Participantes", 'participantes' => $participantes]);
    }

    public function nuevoParticipante()
    {
        return view('admin/participantes_form', ['title' => 'Agregar Participante']);
    }

    public function guardarParticipante()
    {
        $participanteModel = new ParticipanteModel();

        // Insertar en la base de datos
        $participanteModel->insert([
            'nombre_completo' => $this->request->getPost('nombre_completo'),
            'dni' => $this->request->getPost('dni'),
            'numero' => $this->request->getPost('numero'),
            'tipo' => $this->request->getPost('tipo'),
            'correo' => $this->request->getPost('correo'),
            'puntaje' => $this->request->getPost('puntaje')
        ]);

        // Retornar JSON si es una API o redirigir si es vista
        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(201)->setJSON(['message' => 'Participante agregado exitosamente']);
        }

        return redirect()->to('/admin/participantes')->with('success', 'Participante agregado exitosamente');
    }

    public function editarParticipante($id)
    {
        $participanteModel = new ParticipanteModel();
        $participante = $participanteModel->getParticipanteById($id);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON($participante);
        }

        return view('admin/participantes_edit', ['participante' => $participante]);
    }

    public function actualizarParticipante($id)
    {
        $participanteModel = new ParticipanteModel();

        $updateData = [
            'nombre_completo' => $this->request->getPost('nombre_completo'),
            'dni' => $this->request->getPost('dni'),
            'numero' => $this->request->getPost('numero'),
            'tipo' => $this->request->getPost('tipo'),
            'correo' => $this->request->getPost('correo'),
            'puntaje' => $this->request->getPost('puntaje')
        ];

        $participanteModel->update($id, $updateData);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Participante actualizado exitosamente']);
        }

        return redirect()->to('/admin/participantes')->with('success', 'Participante actualizado exitosamente');
    }

    public function eliminarParticipante($id)
    {
        $participanteModel = new ParticipanteModel();

        if (!$participanteModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'El participante no existe.']);
        }

        $participanteModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Participante eliminado exitosamente']);
        }

        return redirect()->to('/admin/participantes')->with('success', 'Participante eliminado exitosamente.');
    }
}

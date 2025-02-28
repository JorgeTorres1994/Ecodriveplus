<?php

namespace App\Controllers;

use App\Models\SorteoModel;
use App\Models\PremioModel;
use App\Models\ParticipanteModel;
use App\Models\SorteoParticipantesModel;
use App\Models\SorteoGanadoresModel;
use CodeIgniter\RESTful\ResourceController;

class SorteoController extends ResourceController
{
    public function index()
    {
        $sorteoModel = new SorteoModel();
        $premioModel = new PremioModel();
        $participanteModel = new ParticipanteModel();

        $data = [
            'sorteos' => $sorteoModel->findAll(),
            'premios' => $premioModel->findAll(), // Obtener premios disponibles
            'participantes' => $participanteModel->findAll() // Obtener participantes inscritos
        ];

        return view('admin/sorteos_list', $data);
    }

    public function nuevo()
    {
        return view('admin/sorteos_form', ['title' => 'Crear Nuevo Sorteo']);
    }

    public function guardarSorteo()
    {
        $titulo = $this->request->getPost("titulo");
        $descripcion = $this->request->getPost("descripcion");
        $tipo = $this->request->getPost("tipo");
        $fecha = $this->request->getPost("fecha");

        $sorteoModel = new SorteoModel();
        $sorteoModel->save([
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'tipo' => $tipo,
            'fecha' => $fecha,
            'estado' => 'pendiente'
        ]);

        return redirect()->to('/admin/sorteos')->with('success', 'Sorteo creado correctamente.');
    }

    public function realizarSorteo()
    {


        $data = $this->request->getJSON(true);
        if ($data == null) {
            return $this->response->setJSON(['error' => 'Datos inválidos'])->setStatusCode(400);
        }

        //Validaciones de campos 
        if (!array_key_exists("participantes", $data)) {
            return $this->response->setJSON(['error' => 'Debe seleccionar al menos un participante'])->setStatusCode(400);
        }
        if (!array_key_exists("premios", $data)) {
            return $this->response->setJSON(['error' => 'Debe seleccionar al menos un premio'])->setStatusCode(400);
        }
        if (!array_key_exists("id_sorteo", $data)) {
            return $this->response->setJSON(['error' => 'Debe ingresar el id del sorteo.'])->setStatusCode(400);
        }

        $participantes = $data['participantes'];
        $premios = $data['premios']; // array con al menos 1 elemento
        $id_sorteo = $data['id_sorteo'];

        $sorteoModel = new SorteoModel();
        $sorteo = $sorteoModel->getSorteoById($id_sorteo);
        if (is_null($sorteo)) {
            return $this->response->setJSON(['error' => 'El sorteo no existe'])->setStatusCode(400);
        }

        //validaciones para el gran premio del mes
        if ($sorteo["tipo"] == "gran_premio") {
            if (count($premios) != 2) {
                return $this->response->setJSON(['error' => 'Solo puede seleccionar dos premios por sorteo Gran Premio'])->setStatusCode(400);
            }
        } else {
            if (count($premios) != 1) {
                return $this->response->setJSON(['error' => 'Solo puede seleccionar un premio para el sorteo de tipo ' . $sorteo["tipo"]])->setStatusCode(400);
            }
        }

        $participanteModel = new ParticipanteModel();
        $premioModel = new PremioModel();

        //x = Puntaje individual de un participante
        //y = Suma total del puntaje de TODOS LOS PARTICIPANTES
        //z = % que tiene de ganar tal participante
        // z = x/y

        $participantesBD = $participanteModel->getParticipantesById($participantes);
        $premiosBD = $premioModel->getPremiosByIds($premios);


        //validar participantes del mismo tipo de sorteo
        if ($sorteo["tipo"] != "gran_premio") {
            foreach ($participantesBD as $participante) {
                if ($participante["tipo"] != $sorteo["tipo"]) {
                    return $this->response->setJSON([
                        'error' => 'El participante [id: ' . $participante["id"] . "] " . $participante["nombre_completo"] . ' no puede participar en este tipo de sorteo',
                        "tipo_sorteo" => $sorteo["tipo"],
                        "tipo_participante" => $participante["tipo"]

                    ])->setStatusCode(400);
                }
            }
        }


        //validar que los premios sean del mismo tipo del sorteo
        if ($sorteo["tipo"] != "gran_premio") {
            foreach ($premiosBD as $premio) {
                if ($premio["tipo"] != $sorteo["tipo"]) {
                    return $this->response->setJSON([
                        'error' => 'El premio ' . $premio["titulo"] . ' no puede ser asignado a este tipo de sorteo',
                        "tipo_sorteo" => $sorteo["tipo"],
                        "tipo_premio" => $premio["tipo"]
                    ])->setStatusCode(400);
                }
            }
        }


        //Obtener el total de puntaje de todos los participantes
        $PUNTAJE_TOTAL = $participanteModel->getPuntosTotales();


        //Obtener el porcentaje de ganar de cada participante
        foreach ($participantesBD as $key => $participante) {
            if ($participante['puntaje'] == 0) {
                return $this->response->setJSON([
                    'error' => 'El participante [id: ' . $participante["id"] . "] " . $participante["nombre_completo"] . ' no tiene puntaje acumulado',
                ])->setStatusCode(400);
            }
            $participantesBD[$key]['porcentaje_ganar'] = ($participante['puntaje'] / $PUNTAJE_TOTAL);
        }

        //Generar participantes para sorteo
        $participantesSorteo = [];
        foreach ($participantesBD as $participante) {
            $porcentaje =  $participante['porcentaje_ganar'] * 100;
            for ($i = 0; $i < $porcentaje; $i++) {
                $participantesSorteo[] = $participante;
            }
        }

        //Obtener un ganador aleatorio

        if ($sorteo["tipo"] == "gran_premio") {
            //Pueden haber 2 ganadores
            $ganador = $participantesSorteo[array_rand($participantesSorteo)];
            //Asignamos un premio aleatorio al ganador
            $ganador["premio"] = $premiosBD[array_rand($premiosBD)];

            //quitar de la lista $participantesSorteo al ganador
            $participantesSorteo2 = array_filter($participantesSorteo, function ($participante) use ($ganador) {
                return $participante["id"] != $ganador["id"];
            });

            //quitar de la lista $premiosBD al premio asignado al ganador
            $premiosBd2 = array_filter($premiosBD, function ($premio) use ($ganador) {
                return $premio["id"] != $ganador["premio"];
            });

            //generar ganador 2
            $ganador2 = $participantesSorteo2[array_rand($participantesSorteo)];
            $ganador2["premio"] = $premiosBd2[0];
        } else {
            //Solo puede haber un ganador
            $ganador = $participantesSorteo[array_rand($participantesSorteo)];
            $ganador["premio"] = $premiosBD[0];
        }

        //TODO:  guardar los ganadores en la tabla sorteo_ganadores

        $data = [];
        foreach ($participantesBD as $participante) {
            if ($sorteo["tipo"] == "gran_premio") {
                if ($ganador["id"] == $participante["id"]) {
                    $data[] = [
                        "sorteo_id" => $id_sorteo,
                        "participante_id" => $participante["id"],
                        "premio_id" => $ganador["premio"]["id"],
                        "es_ganador" => 1
                    ];
                } else if ($ganador2["id"] == $participante["id"]) {
                    $data[] = [
                        "sorteo_id" => $id_sorteo,
                        "participante_id" => $participante["id"],
                        "premio_id" => $ganador2["premio"]["id"],
                        "es_ganador" => 1
                    ];
                } else {
                    $data[] = [
                        "sorteo_id" => $id_sorteo,
                        "participante_id" => $participante["id"],
                        "premio_id" => null,
                        "es_ganador" => 0
                    ];
                }
            } else {
                if ($ganador["id"] == $participante["id"]) {
                    $data[] = [
                        "sorteo_id" => $id_sorteo,
                        "participante_id" => $participante["id"],
                        "premio_id" => $ganador["premio"]["id"],
                        "es_ganador" => 1
                    ];
                } else {
                    $data[] = [
                        "sorteo_id" => $id_sorteo,
                        "participante_id" => $participante["id"],
                        "premio_id" => null,
                        "es_ganador" => 0
                    ];
                }
            }
        }

        //Se registran todos los participantes 
        $sorteoParticipantesModel = new SorteoParticipantesModel();
        $sorteoParticipantesModel->registrarParticipante($data);

        //Cambiar estado del sorteo a "realizado"
        $sorteoModel->setEstado($id_sorteo, "realizado");

        //cambiar puntaje de los participantes a 0
        $participanteModel->resetPuntaje($participantesBD);

        return $this->response->setJSON(
            [
                "sorteo" => $sorteo,
                'participantesBD' => $participantesBD,
                'premios' => $premiosBD,
                'ganador' => $ganador,
                'ganador2' => $sorteo["tipo"] == "gran_premio" ? $ganador2 : "NO APLICA"
            ]
        );
    }




    public function eliminar($id)
    {
        $sorteoModel = new SorteoModel();
        $sorteoModel->delete($id);

        return redirect()->to('/admin/sorteos')->with('success', 'Sorteo eliminado correctamente.');
    }
}

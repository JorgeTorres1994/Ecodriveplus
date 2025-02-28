<?php

namespace App\Models;

use CodeIgniter\Model;

class GanadoresModel extends Model
{
    protected $table = 'sorteo_participantes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sorteo_id', 'participante_id', 'premio_id', 'es_ganador'];

    public function obtenerGanadores()
    {
        return $this->select('sorteo_participantes.id, sorteos.titulo as sorteo_titulo, sorteos.fecha as sorteo_fecha, participantes.nombre_completo, premios.titulo as premio_titulo, premios.imagen as premio_imagen, sorteo_participantes.es_ganador')
            ->join('sorteos', 'sorteos.id = sorteo_participantes.sorteo_id')
            ->join('participantes', 'participantes.id = sorteo_participantes.participante_id')
            ->join('premios', 'premios.id = sorteo_participantes.premio_id', 'left')
            ->orderBy('sorteo_participantes.id', 'ASC')
            ->findAll();
    }
}
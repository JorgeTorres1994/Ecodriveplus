<?php

namespace App\Models;

use CodeIgniter\Model;

class SorteoParticipantesModel extends Model
{
    protected $table      = 'sorteo_participantes'; // Tabla actualizada
    protected $primaryKey = 'id';

    protected $allowedFields = ['sorteo_id', 'participante_id', 'premio_id', 'es_ganador'];

    public function registrarParticipante(array $data)
    {
        return $this->insertBatch($data);
    }
}

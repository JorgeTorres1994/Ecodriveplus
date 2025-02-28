<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipanteModel extends Model
{
    protected $table = 'participantes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre_completo', 'dni', 'numero', 'tipo', 'correo', 'puntaje'];

    // Obtener todos los participantes
    public function getAllParticipantes()
    {
        return $this->findAll();
    }

    // Obtener un participante por ID
    public function getParticipanteById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getParticipantesById(array $ids)
    {
        return $this->whereIn('id', $ids)->findAll();
    }

    public function getPuntosTotales()
    {
        return $this->selectSum('puntaje')->first()["puntaje"];
    }

    public function resetPuntaje(array $participantesBD)
    {
        $arrayIdParticipante = array_column($participantesBD, 'id');
        $this->whereIn('id', $arrayIdParticipante)->set(['puntaje' => 0])->update();
    }
}

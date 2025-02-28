<?php

namespace App\Models;

use CodeIgniter\Model;

class SorteoModel extends Model
{
    protected $table = 'sorteos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'descripcion', 'tipo', 'fecha', 'estado', 'created_at'];

    // Obtener todos los sorteos
    public function getAllSorteos()
    {
        return $this->orderBy('fecha', 'DESC')->findAll();
    }

    // Obtener un sorteo por ID
    public function getSorteoById($id)
    {
        return $this->where('id', $id)->first();
    }
    public function setEstado(int $id, $estado)
    {
        $this->set('estado', $estado);
        $this->where('id', $id);
        $this->update();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class BeneficioModel extends Model
{
    protected $table = 'beneficios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'descripcion','sede','dias','imagen'];

    // Obtener todos los beneficios
    public function getAllBeneficios()
    {
        return $this->findAll();
    }

    // Obtener un beneficio por ID
    public function getBeneficioById($id)
    {
        return $this->where('id', $id)->first();
    }
}

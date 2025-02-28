<?php

namespace App\Models;

use CodeIgniter\Model;

class PremioModel extends Model
{
    protected $table = 'premios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['imagen', 'titulo', 'descripcion', 'tipo', 'dia'];

    // Obtener todos los premios
    public function getAllPremios()
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }

    // Obtener un premio por ID
    public function getPremioById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getPremiosByIds(array $ids)
    {
        return $this->whereIn('id', $ids)->findAll();
    }
}

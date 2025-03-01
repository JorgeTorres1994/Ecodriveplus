<?php

namespace App\Models;

use CodeIgniter\Model;

class PremioModel extends Model
{
    protected $table = 'premios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['imagen', 'titulo', 'descripcion', 'tipo', 'dia'];
    protected $useAutoIncrement = true; // Para evitar conflictos con IDs
    protected $useTimestamps = false; // Desactiva timestamps si no los usas

    // ✅ Método para paginar premios correctamente
    public function obtenerPremiosPaginados($perPage = 5)
    {
        return $this->paginate($perPage, 'default');
    }


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

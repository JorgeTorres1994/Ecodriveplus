<?php

namespace App\Models;

use CodeIgniter\Model;

class MultimediaModel extends Model
{
    protected $table = 'multimedia';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'subtitulo', 'detalle', 'nota', 'fecha', 'imagen', 'created_at'];

    // Obtener todas las entradas de multimedia
    public function getAllMultimedia()
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }


    // Obtener un solo registro por ID
    public function getMultimediaById($id)
    {
        return $this->where('id', $id)->first();
    }
}

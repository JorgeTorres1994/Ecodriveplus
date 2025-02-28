<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'password', 'rol'];

    // Obtener todos los usuarios
    public function getAllUsuarios()
    {
        return $this->findAll();
    }

    // Obtener un usuario por ID
    public function getUsuarioById($id)
    {
        return $this->where('id', $id)->first();
    }

    // Obtener un usuario por correo electrónico
    public function getUsuarioByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}

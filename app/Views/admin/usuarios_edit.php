<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/usuarios_edit.css'); ?>">

<div class="form-container">
    <form action="<?= base_url('/admin/usuarios/actualizar/' . ($usuario_admin['id'] ?? '')) ?>" method="POST">
        <h2 class="text-center">Editar Administrador</h2>

        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= esc($usuario_admin['nombre'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo Electrónico:</label>
            <input type="email" name="email" class="form-control" value="<?= esc($usuario_admin['email'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva Contraseña (Opcional):</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Rol:</label>
            <select name="rol" class="form-control">
                <option value="admin" <?= (isset($usuario_admin['rol']) && $usuario_admin['rol'] == 'admin') ? 'selected' : '' ?>>Administrador</option>
                <option value="editor" <?= (isset($usuario_admin['rol']) && $usuario_admin['rol'] == 'editor') ? 'selected' : '' ?>>Editor</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>

<?= $this->endSection() ?>

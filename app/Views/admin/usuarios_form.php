<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/usuarios_form.css'); ?>">

<h2 class="text-center my-4">Agregar Administrador</h2>

<div class="form-container">
    <form action="<?= base_url('/admin/usuarios/guardar') ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correo Electrónico:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Rol:</label>
            <select name="rol" class="form-control">
                <option value="admin">Administrador</option>
                <option value="editor">Editor</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<?= $this->endSection() ?>
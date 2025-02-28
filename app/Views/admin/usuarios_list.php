<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Gestión de Administradores</h2>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<a href="<?= base_url('/admin/usuarios/nuevo') ?>" class="btn btn-primary mb-3">Agregar Administrador</a>

<!-- Tabla de Administradores -->
<div class="table-responsive">
    <table class="table table-striped table-hover text-center align-middle shadow-sm border rounded">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios_admin)) : ?>
                <?php foreach ($usuarios_admin as $usuario) : ?>
                    <tr>
                        <td><?= esc($usuario['id']) ?></td>
                        <td><?= esc($usuario['nombre']) ?></td>
                        <td><?= esc($usuario['email']) ?></td>
                        <td><?= ucfirst(esc($usuario['rol'])) ?></td>
                        <td class="acciones">
                            <a href="<?= base_url('/admin/usuarios/editar/' . $usuario['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="<?= base_url('/admin/usuarios/eliminar/' . $usuario['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center">No hay administradores registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

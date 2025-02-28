<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Gestión de Beneficios</h2>

<!-- Mensaje de éxito -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<!-- Botón para agregar nuevo beneficio -->
<a href="<?= base_url('/admin/beneficios/nuevo') ?>" class="btn btn-primary mb-3">Agregar Beneficio</a>

<!-- Tabla de Beneficios -->
<div class="table-responsive">
    <table class="table table-striped table-hover text-center align-middle shadow-sm border rounded">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Sede</th>
                <th>Días</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($beneficios as $beneficio): ?>
            <tr>
                <td><?= $beneficio['id'] ?></td>
                <td><?= $beneficio['titulo'] ?></td>
                <td><?= $beneficio['descripcion'] ?></td>
                <td><?= $beneficio['sede'] ?></td>
                <td><?= $beneficio['dias'] ?></td>
                <td>
                    <?php if (!empty($beneficio['imagen'])) : ?>
                        <img src="<?= base_url($beneficio['imagen']) ?>" class="img-thumbnail" width="60" height="60">
                    <?php else : ?>
                        <span class="text-muted">Sin imagen</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url('/admin/beneficios/editar/'.$beneficio['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="<?= base_url('/admin/beneficios/eliminar/'.$beneficio['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este beneficio?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

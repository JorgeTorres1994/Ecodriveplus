<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Gestión de Multimedia</h2>

<!-- Mensaje de éxito -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<!-- Botón para agregar nueva multimedia -->
<a href="<?= base_url('/admin/multimedia/nuevo') ?>" class="btn btn-primary mb-3">Agregar Multimedia</a>

<!-- Tabla de Multimedia -->
<div class="table-responsive">
    <table class="table table-striped table-hover text-center align-middle shadow-sm border rounded">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Detalle</th>
                <th>Nota</th>
                <th>Fecha</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($multimedia as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['titulo'] ?></td>
                <td><?= $item['subtitulo'] ?></td>
                <td><?= $item['detalle'] ?></td>
                <td><?= $item['nota'] ?></td>
                <td><?= $item['fecha'] ?></td>
                <td>
                    <?php if (!empty($item['imagen'])) : ?>
                        <img src="<?= base_url($item['imagen']) ?>" class="img-thumbnail" width="60" height="60">
                    <?php else : ?>
                        <span class="text-muted">Sin imagen</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url('/admin/multimedia/editar/'.$item['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="<?= base_url('/admin/multimedia/eliminar/'.$item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este contenido?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

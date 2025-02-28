<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <h2 class="text-center my-4 text-primary">Gestión de Participantes</h2>

    <!-- Mensaje de éxito -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mb-3">
        <a href="<?= base_url('/admin/participantes/nuevo') ?>" class="btn btn-primary">➕ Agregar Participante</a>

        <!-- Botón para importar participantes desde Excel -->
        <form action="<?= base_url('/admin/participantes/importar') ?>" method="post" enctype="multipart/form-data" class="d-flex gap-2">
            <?= csrf_field(); ?>
            <input type="file" name="file" class="form-control" accept=".xls,.xlsx" required>
            <button type="submit" class="btn btn-success">📥 Importar</button>
        </form>
    </div>

    <!-- Tabla de Participantes -->
    <div class="table-responsive shadow-lg p-3 mb-5 bg-white rounded">
        <table class="table table-striped table-hover text-center align-middle border rounded">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>DNI</th>
                    <th>Número</th>
                    <th>Tipo</th>
                    <th>Correo</th>
                    <th>Puntaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participantes as $participante): ?>
                <tr>
                    <td><?= $participante['id'] ?></td>
                    <td><?= $participante['nombre_completo'] ?></td>
                    <td><?= $participante['dni'] ?></td>
                    <td><?= $participante['numero'] ?></td>
                    <td><?= ucfirst($participante['tipo']) ?></td>
                    <td><?= $participante['correo'] ?></td>
                    <td><?= $participante['puntaje'] ?></td>
                    <td class="d-flex gap-2 justify-content-center">
                        <a href="<?= base_url('/admin/participantes/editar/'.$participante['id']) ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <a href="<?= base_url('/admin/participantes/eliminar/'.$participante['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este participante?')">🗑️ Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

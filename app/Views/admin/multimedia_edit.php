<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Editar Multimedia</h2>

<!-- Mensaje de error o éxito -->
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<form action="<?= base_url('/admin/multimedia/actualizar/'.$multimedia['id']) ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Título:</label>
        <input type="text" name="titulo" class="form-control" value="<?= esc($multimedia['titulo']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Subtítulo:</label>
        <input type="text" name="subtitulo" class="form-control" value="<?= esc($multimedia['subtitulo']) ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Detalle:</label>
        <input type="text" name="detalle" class="form-control" value="<?= esc($multimedia['detalle']) ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Nota:</label>
        <textarea name="nota" class="form-control"><?= esc($multimedia['nota']) ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha:</label>
        <input type="date" name="fecha" class="form-control" value="<?= esc($multimedia['fecha']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Imagen Actual:</label><br>
        <?php if (!empty($multimedia['imagen'])) : ?>
            <img src="<?= base_url($multimedia['imagen']) ?>" width="100"><br>
        <?php else : ?>
            <p>No hay imagen cargada.</p>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label">Cambiar Imagen:</label>
        <input type="file" name="imagen" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="<?= base_url('/admin/multimedia') ?>" class="btn btn-secondary">Cancelar</a>
</form>

<?= $this->endSection() ?>

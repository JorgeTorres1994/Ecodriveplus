<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Agregar Beneficio</h2>

<!-- Mensajes de error o éxito -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<form action="<?= base_url('/admin/beneficios/guardar') ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Título:</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción:</label>
        <textarea name="descripcion" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Sede:</label>
        <input type="text" name="sede" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Días:</label>
        <input type="text" name="dias" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Imagen:</label>
        <input type="file" name="imagen" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?= $this->endSection() ?>
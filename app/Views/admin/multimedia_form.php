<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Agregar Multimedia</h2>

<form action="<?= base_url('/admin/multimedia/guardar') ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Título:</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Subtítulo:</label>
        <input type="text" name="subtitulo" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Detalle:</label>
        <input type="text" name="detalle" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Nota:</label>
        <textarea name="nota" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha:</label>
        <input type="date" name="fecha" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Imagen:</label>
        <input type="file" name="imagen" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?= $this->endSection() ?>

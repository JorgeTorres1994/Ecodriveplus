<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Agregar Premio</h2>
<form action="<?= base_url('/admin/premios/guardar') ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Título:</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción:</label>
        <textarea name="descripcion" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Tipo:</label>
        <select name="tipo" class="form-control" required>
            <option value="conductor">Conductor</option>
            <option value="pasajero">Pasajero</option>
            <option value="pasajero">Gran premio</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Día:</label>
        <input type="text" name="dia" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Imagen:</label>
        <input type="file" name="imagen" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
<?= $this->endSection() ?>
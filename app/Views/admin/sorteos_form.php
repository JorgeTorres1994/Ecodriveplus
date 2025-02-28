<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Crear Nuevo Sorteo</h2>

<form action="<?= base_url('/admin/sorteos/guardar') ?>" method="POST">
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
            <option value="gran_premio">Gran premio</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Fecha:</label>
        <input type="date" name="fecha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?= $this->endSection() ?>

<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Agregar Participante</h2>

<form action="<?= base_url('/admin/participantes/guardar') ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Nombre Completo:</label>
        <input type="text" name="nombre_completo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">DNI:</label>
        <input type="text" name="dni" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Número de Teléfono:</label>
        <input type="text" name="numero" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tipo:</label>
        <select name="tipo" class="form-control" required>
            <option value="conductor">Conductor</option>
            <option value="pasajero">Pasajero</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Correo Electrónico:</label>
        <input type="email" name="correo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Puntaje:</label>
        <input type="number" name="puntaje" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<?= $this->endSection() ?>
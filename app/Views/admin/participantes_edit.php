<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Editar Participante</h2>

<form action="<?= base_url('/admin/participantes/actualizar/' . $participante['id']) ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Nombre Completo:</label>
        <input type="text" name="nombre_completo" class="form-control" value="<?= $participante['nombre_completo'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">DNI:</label>
        <input type="text" name="dni" class="form-control" value="<?= $participante['dni'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Número de Teléfono:</label>
        <input type="text" name="numero" class="form-control" value="<?= $participante['numero'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tipo:</label>
        <select name="tipo" class="form-control" required>
            <option value="conductor" <?= $participante['tipo'] == 'conductor' ? 'selected' : '' ?>>Conductor</option>
            <option value="pasajero" <?= $participante['tipo'] == 'pasajero' ? 'selected' : '' ?>>Pasajero</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Correo Electrónico:</label>
        <input type="email" name="correo" class="form-control" value="<?= $participante['correo'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Puntaje:</label>
        <input type="number" name="puntaje" class="form-control" value="<?= $participante['puntaje'] ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
</form>

<?= $this->endSection() ?>
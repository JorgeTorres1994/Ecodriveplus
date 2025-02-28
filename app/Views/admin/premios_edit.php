<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Editar Premio</h2>

<form action="<?= base_url('/admin/premios/actualizar/'.$premio['id']) ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Título:</label>
        <input type="text" name="titulo" class="form-control" value="<?= esc($premio['titulo']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción:</label>
        <textarea name="descripcion" class="form-control" required><?= esc($premio['descripcion']) ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipo:</label>
        <select name="tipo" class="form-control" required>
            <option value="conductor" <?= $premio['tipo'] == 'conductor' ? 'selected' : '' ?>>Conductor</option>
            <option value="pasajero" <?= $premio['tipo'] == 'pasajero' ? 'selected' : '' ?>>Pasajero</option>
            <option value="gran premio" <?= $premio['tipo'] == 'gran premio' ? 'selected' : '' ?>>Gran premio</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Día:</label>
        <textarea name="dia" class="form-control" required><?= esc($premio['dia']) ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Imagen Actual:</label><br>
        <?php if (!empty($premio['imagen'])) : ?>
            <img src="<?= base_url($premio['imagen']) ?>" width="100"><br>
        <?php else : ?>
            <p>No hay imagen cargada.</p>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label">Cambiar Imagen:</label>
        <input type="file" name="imagen" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="<?= base_url('/admin/premios') ?>" class="btn btn-secondary">Cancelar</a>
</form>

<?= $this->endSection() ?>

<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Editar Beneficio</h2>

<!-- Mensajes de error o éxito -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<form action="<?= base_url('/admin/beneficios/actualizar/' . $beneficio['id']) ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Título:</label>
        <input type="text" name="titulo" class="form-control" value="<?= $beneficio['titulo'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción:</label>
        <textarea name="descripcion" class="form-control" required><?= $beneficio['descripcion'] ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Sede:</label>
        <input type="text" name="sede" class="form-control" value="<?= $beneficio['sede'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Días:</label>
        <input type="text" name="dias" class="form-control" value="<?= $beneficio['dias'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Imagen Actual:</label><br>
        <?php if (!empty($beneficio['imagen'])) : ?>
            <img src="<?= base_url($beneficio['imagen']) ?>" width="100"><br>
        <?php else : ?>
            <p>No hay imagen cargada.</p>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label">Cambiar Imagen:</label>
        <input type="file" name="imagen" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="<?= base_url('/admin/beneficios') ?>" class="btn btn-secondary">Cancelar</a>
</form>

<?= $this->endSection() ?>
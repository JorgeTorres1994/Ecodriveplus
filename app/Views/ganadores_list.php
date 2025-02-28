<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Lista de Ganadores</h2>
<div class="table-responsive">
    <table class="table table-striped table-hover text-center align-middle shadow-sm border rounded">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Sorteo</th>
                <th>Participante</th>
                <th>Premio</th>
                <th>Imagen Premio</th>
                <th>Ganador</th>
                <th>Fecha del Sorteo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ganadores as $g) : ?>
                <tr>
                    <td><?= $g['id'] ?></td>
                    <td><?= $g['sorteo_titulo'] ?></td>
                    <td><?= $g['nombre_completo'] ?></td>
                    <td><?= $g['premio_titulo'] ?? 'Sin premio' ?></td>
                    <td>
                        <?php if (!empty($g['premio_imagen'])) : ?>
                            <img src="<?= base_url($g['premio_imagen']) ?>" class="img-thumbnail" width="60" height="60">
                        <?php else : ?>
                            <span class="text-muted">Sin imagen</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge <?= $g['es_ganador'] ? 'bg-success' : 'bg-danger' ?>">
                            <?= $g['es_ganador'] ? 'Sí' : 'No' ?>
                        </span>
                    </td>
                    <td><?= date('d/m/Y', strtotime($g['sorteo_fecha'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>

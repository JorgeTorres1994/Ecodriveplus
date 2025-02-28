<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<h2 class="text-center my-4">Gestión de Sorteos</h2>

<!-- Mensaje de éxito -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<!-- Botón para agregar nuevo premio -->
<a href="<?= base_url('/admin/sorteos/nuevo') ?>" class="btn btn-primary mb-3">Agregar Sorteo</a>

<div class="row">
    <div class="col-md-8" style=" text-overflow: ellipsis; overflow-y:scroll; height: 600px;">
        <?php foreach ($sorteos as $sorteo): ?>
            <div class="card mb-3" >
                <div class="card-body">
                    <h4><?= $sorteo['titulo'] ?></h4>
                    <p><strong>Fecha:</strong> <?= $sorteo['fecha'] ?></p>
                    <p><strong>Estado:</strong>
                        <span class="badge <?= $sorteo['estado'] == 'pendiente' ? 'bg-warning' : 'bg-success' ?>">
                            <?= ucfirst($sorteo['estado']) ?>
                        </span>
                    </p>
                    <p>
                        <strong>Tipo sorteo:</strong> <span class="badge bg-primary"><?= $sorteo['tipo'] ?></span>
                    </p>
                    <!-- <a href="= base_url('/admin/sorteos/realizar/' . $sorteo['id']) ?>" class="btn btn-success">Realizar Sorteo</a> -->
                    <button class="btn btn-success" <?= $sorteo['estado'] == "realizado" ? "disabled" : "" ?> onclick="realizarSorteo('<?= $sorteo['id'] ?>');">Realizar Sorteo</button>
                    <!-- <a href="= base_url('/admin/sorteos/eliminar/' . $sorteo['id']) ?>" class="btn btn-danger">Eliminar</a> -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="col-md-4">
        <!-- 📌 Tarjeta de Premios Disponibles -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <ul class="nav nav-tabs card-header-tabs" id="premiosTab">
                    <li class="nav-item">
                        <a class="nav-link active" id="premios-conductores-tab" data-bs-toggle="tab" href="#premios-conductores">Conductores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="premios-pasajeros-tab" data-bs-toggle="tab" href="#premios-pasajeros">Pasajeros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="premios-granpremio-tab" data-bs-toggle="tab" href="#premios-granpremio">Gran Premio</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Premios para Conductores -->
                    <div class="tab-pane fade show active" id="premios-conductores">
                        <ul class="list-group">
                            <?php foreach ($premios as $premio): ?>
                                <?php if ($premio['tipo'] == 'conductor'): ?>
                                    <li class="list-group-item d-flex align-items-center justify-content-between premio-item">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url($premio['imagen']) ?>" alt="<?= esc($premio['titulo']) ?>" width="50" height="50" class="me-2 rounded">
                                            <?= esc($premio['titulo']) ?>
                                        </div>
                                        <button class="btn btn-sm btn-primary ms-auto select-premio" data-id="<?= $premio['id'] ?>" data-titulo="<?= esc($premio['titulo']) ?>">Seleccionar</button>
                                    </li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Premios para Pasajeros -->
                    <div class="tab-pane fade" id="premios-pasajeros">
                        <ul class="list-group">
                            <?php foreach ($premios as $premio): ?>
                                <?php if ($premio['tipo'] == 'pasajero'): ?>
                                    <li class="list-group-item d-flex align-items-center justify-content-between premio-item">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url($premio['imagen']) ?>" alt="<?= esc($premio['titulo']) ?>" width="50" height="50" class="me-2 rounded">
                                            <?= esc($premio['titulo']) ?>
                                        </div>
                                        <button class="btn btn-sm btn-primary ms-auto select-premio" data-id="<?= $premio['id'] ?>" data-titulo="<?= esc($premio['titulo']) ?>">Seleccionar</button>
                                    </li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Premios para Gran Premio -->
                    <div class="tab-pane fade" id="premios-granpremio">
                        <ul class="list-group">
                            <?php foreach ($premios as $premio): ?>
                                <?php if ($premio['tipo'] == 'gran premio'): ?>
                                    <li class="list-group-item d-flex align-items-center justify-content-between premio-item">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url($premio['imagen']) ?>" alt="<?= esc($premio['titulo']) ?>" width="50" height="50" class="me-2 rounded">
                                            <?= esc($premio['titulo']) ?>
                                        </div>
                                        <button class="btn btn-sm btn-primary ms-auto select-premio" data-id="<?= $premio['id'] ?>" data-titulo="<?= esc($premio['titulo']) ?>">Seleccionar</button>
                                    </li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- 📌 Tarjeta de Participantes Inscritos -->
        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                <ul class="nav nav-tabs card-header-tabs" id="participantesTab">
                    <li class="nav-item">
                        <a class="nav-link active" id="participantes-conductores-tab" data-bs-toggle="tab" href="#participantes-conductores">Conductores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="participantes-pasajeros-tab" data-bs-toggle="tab" href="#participantes-pasajeros">Pasajeros</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Participantes Conductores -->
                    <div class="tab-pane fade show active" id="participantes-conductores">
                        <ul class="list-group">
                            <?php foreach ($participantes as $participante): ?>
                                <?php if ($participante['tipo'] == 'conductor'): ?>
                                    <li class="list-group-item d-flex align-items-center justify-content-between participante-item">
                                        <span><?= esc($participante['nombre_completo']) ?> (<?= esc($participante['dni']) ?>)</span>
                                        <button class="btn btn-sm btn-success ms-auto select-participante" data-id="<?= $participante['id'] ?>" data-nombre="<?= esc($participante['nombre_completo']) ?>">Seleccionar</button>
                                    </li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Participantes Pasajeros -->
                    <div class="tab-pane fade" id="participantes-pasajeros">
                        <ul class="list-group">
                            <?php foreach ($participantes as $participante): ?>
                                <?php if ($participante['tipo'] == 'pasajero'): ?>
                                    <li class="list-group-item d-flex align-items-center justify-content-between participante-item">
                                        <span><?= esc($participante['nombre_completo']) ?> (<?= esc($participante['dni']) ?>)</span>
                                        <button class="btn btn-sm btn-success ms-auto select-participante" data-id="<?= $participante['id'] ?>" data-nombre="<?= esc($participante['nombre_completo']) ?>">Seleccionar</button>
                                    </li>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Resultados del Sorteo -->
    <div class="modal fade" id="modalResultados" tabindex="-1" aria-labelledby="modalResultadosLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalResultadosLabel">Resultados del Sorteo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body" id="modalResultadosBody">
                    <!-- Aquí se mostrarán los resultados -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var base_url = "<?= base_url(); ?>";
        var sorteo_id = "<?= $sorteo['id'] ?? '' ?>"; // ID del sorteo desde PHP
    </script>

    <!-- 📌 Incluir el archivo JavaScript externo -->
    <script src="<?= base_url('assets/js/sorteos.js') ?>"></script>


    <?= $this->endSection() ?>
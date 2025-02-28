<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>

    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        /* Ajustes para el sidebar */
        .sidebar {
            width: 250px;
            min-height: 100vh;
        }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .content {
            flex-grow: 1;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="btn btn-outline-light d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/admin/dashboard') ?>">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/logout') ?>">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar para pantallas grandes -->
    <div class="d-flex">
        <div class="sidebar bg-dark text-white p-3 d-none d-lg-block">
            <h4 class="text-center">Menú</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/premios') ?>"><i class="fa fa-gift"></i> Premios</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/beneficios') ?>"><i class="fa fa-hand-holding-heart"></i> Beneficios</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/sorteos') ?>"><i class="fa fa-ticket-alt"></i> Sorteos</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/participantes') ?>"><i class="fa fa-users"></i> Participantes</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/ganadores') ?>"><i class="fa fa-trophy"></i> Ganadores</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/multimedia') ?>"><i class="fa fa-image"></i> Multimedia</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/usuarios') ?>"><i class="fa fa-user-shield"></i> Admins</a></li>
            </ul>
        </div>

        <!-- Sidebar Offcanvas para móviles -->
        <div class="offcanvas offcanvas-start bg-dark text-white" id="offcanvasSidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menú</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/premios') ?>"><i class="fa fa-gift"></i> Premios</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/beneficios') ?>"><i class="fa fa-hand-holding-heart"></i> Beneficios</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/sorteos') ?>"><i class="fa fa-ticket-alt"></i> Sorteos</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/participantes') ?>"><i class="fa fa-users"></i> Participantes</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/ganadores') ?>"><i class="fa fa-trophy"></i> Ganadores</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/multimedia') ?>"><i class="fa fa-image"></i> Multimedia</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="<?= base_url('/admin/usuarios') ?>"><i class="fa fa-user-shield"></i> Admins</a></li>
                </ul>
            </div>
        </div>

        <!-- Contenido Principal -->
        <div class="container mt-4 content">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

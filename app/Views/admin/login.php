<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Ecodrive +</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">

</head>

<body>

    <div class="title-container">
        <h1>Ecodrive +</h1>
    </div>

    <div class="login-container">
        <h2>Bienvenido al inicio de sesión</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <p class="error-message"><?= session()->getFlashdata('error'); ?></p>
        <?php endif; ?>

        <form action="<?= base_url('/login'); ?>" method="post">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" value="" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" value="" required>

            <button type="submit">Ingresar</button>
        </form>

    </div>

</body>

</html>
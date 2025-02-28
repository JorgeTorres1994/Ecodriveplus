<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Ecodrive +</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <div class="title-container">
        <h1>Ecodrive +</h1>
    </div>

    <div class="login-container">
        <h2>Bienvenido al inicio de sesión</h2>

        <!-- Mensaje Flotante -->
        <div id="errorToast" class="toast"></div>

        <form action="<?= base_url('/login'); ?>" method="post" id="loginForm">
            <?= csrf_field(); ?> <!-- CSRF Token -->

            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Ingresar</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#loginForm").submit(function(event) {
                event.preventDefault(); // Evita la recarga de la página

                $.ajax({
                    url: "<?= base_url('/login'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $("input[name=csrf_test_name]").val() // Enviar CSRF Token si es necesario
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            window.location.href = response.redirect; // Redirigir al dashboard inmediatamente
                        }
                    },
                    error: function(xhr) {
                        $("#errorToast").text(xhr.responseJSON.message).fadeIn().delay(3000).fadeOut();
                    }
                });
            });
        });
    </script>


</body>

</html>
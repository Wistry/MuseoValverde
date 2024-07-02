<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <title>Valverde - Alta Usuario</title>
    <link rel="stylesheet" href="../css/altausuario.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="altausuario_validation.js" defer></script>
</head>
<body>
    <?php
        // Si hay un mensaje en la sesión, muéstralo con SweetAlert2 y luego elimínalo
        if (isset($_SESSION['mensajeError'])) {
            echo "
                <script>
                Swal.fire({
                    title: 'Error!',
                    text: '".$_SESSION['mensajeError']."',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                </script>";
            unset($_SESSION['mensajeError']);
        }
    ?>
    <article class="container">
        <h1>Registro</h1><hr>
        <form action="registro.php" method="post" class="RegistrarUser">
            <article class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre">
            </article>

            <article class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario">
            </article>

            <article class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="text" id="contrasena" name="contrasena">
            </article>

            <article class="form-group">
                <label for="confirmar_contrasena">Confirmar contraseña:</label>
                <input type="text" id="confirmar_contrasena" name="confirmar_contrasena">
            </article>

            <article class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
            </article>

            <article class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono">
            </article>

            <article class="form-group">
                <input type="submit" value="Registrarse">
            </article>
        </form>
    </article>
</body>
</html>

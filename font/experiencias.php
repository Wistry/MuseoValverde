<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    session_start();
    include 'db_connect.php'; 
    ?>

    <meta charset="UTF-8">
    <title>Valverde - Experiencias</title>
    <link rel="stylesheet" type="text/css" href="../css/index.css" />
    <link rel="stylesheet" type="text/css" href="../css/experiencias.css" />
    <script src=" iniciarsesion_validation.js" defer></script>
</head>

<body>
    <?php
        // Si hay un mensaje en la sesión, muéstralo con SweetAlert2 y luego elimínalo
        if (isset($_SESSION['mensajeini'])) {
            echo "
                <script>
                Swal.fire({
                    title: 'Error!',
                    text: '".$_SESSION['mensajeini']."',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                </script>";
            unset($_SESSION['mensajeini']);
        }
    ?>

    <section class="header-body">
        <header>
            <h1>MUSEO VALVERDE</h1>
            <img src="../imagenes/logotipo.png" class="logo">
            <nav class="grip-layout">
                <?php
                if (isset($_SESSION['usuario'])) {

                    echo '<div class="welcome-message">';
                        echo '<h3>Bienvenido, ' . htmlspecialchars($_SESSION['usuario']) . '!</h3>';
                        echo '<button onclick="location.href=\'logout.php\'" type="button">Cerrar sesión</button>';
                    echo '</div>';
                } else 
                {
                ?>
                    <form class="Registro" action="login.php" method="post">
                        <article>
                            <label for="bt1">Usuario:</label>
                            <input type="text" id="bt1" name="usuario" value="">
                        </article>

                        <article>
                            <label for="bt2">Contraseña:</label>
                            <input type="text" id="bt2" name="contrasena" value="">
                        </article>

                        <article>
                            <hr>
                            <label for="bt3"></label>
                            <input type="submit" id="bt3" value="Iniciar Sesion">
                        </article>

                        <article>
                            <hr>
                            <label for="bt4"></label>
                            <input type="button" id="bt4" value="Registrarse"
                                onclick="window.location.href='altausuario.php'">
                        </article>
                    </form>
                <?php
                }
                ?>

                <article class="Menu">
                    <ul>
                        <li><a href="../index.php">Inicio</a></li>
                        <li><a href="coleccion.php">Colección</a></li>
                        <li><a href="exposiciones.php">Exposiciones</a></li>
                        <li><a href="visita.php">Visita</a></li>
                        <li><a href="informacion.php">Información</a></li>
                        <li><a href="experiencias.php">Experiencias</a></li>
                    </ul>
                </article>
            </nav>
        </header>
        <hr>
    </section>

    <main class="container">
        <section class="inicio formulario-comentario">
            <h1>Opiniones</h1>
            <hr>
            <article>
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo '<form id="comentarioForm" action="registrarcomentario.php" method="post">
                        <label for="bt1">Usuario:</label>
                        <input type="text" id="bt1" name="usuario" value="'.$_SESSION['usuario'].'">
                        <br>
                        <label for="bt2">Reseña:</label>
                        <textarea id="bt2" name="comentario"></textarea>
                        <br>
                        <input style="float: right;" type="submit" value="Enviar">
                    </form>';
                } else {
                    echo 'Debes iniciar sesión para dejar un comentario.';
                }
                ?>
            </article>
            <script>
                // Función para validar el formulario
                function validarFormulario(event) {
                    event.preventDefault(); 
                    
                    let comentario = document.getElementById('bt2').value;

                    if (comentario.trim() === "") {
                        alert("El campo reseña es obligatorio.");
                    }else if (comentario.length > 500) {
                        alert("El campo reseña no puede tener más de 500 caracteres.");
                    }
                    else{
                        document.getElementById('comentarioForm').submit();
                    }
                }

                document.getElementById('comentarioForm').addEventListener('submit', validarFormulario);

                window.onload = function() {
                    document.getElementById('bt1').readOnly = true;
                };

            </script>
        </section>

        <section class="comentarios-container">
        <?php
            $sql = "SELECT Comentarios.id, Usuarios.usuario, Comentarios.comentario FROM Comentarios INNER JOIN Usuarios ON Comentarios.usuario = Usuarios.usuario ORDER BY Comentarios.id DESC";
            $stmt = $conn->prepare($sql);

            $stmt->execute();
            $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($comentarios as $comentario) {
                echo '<section class="reseña">
                    <b>'.htmlspecialchars($comentario['usuario']).'</b>
                    <hr>
                    <p>'.htmlspecialchars($comentario['comentario']).'</p>';
            
                    // Si el usuario es 'admin', muestra un botón de borrar
                    if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === 'admin') {
                        echo '<form action="delete_comentario.php" method="post">
                            <input type="hidden" name="comment_id" value="'.htmlspecialchars($comentario['id']).'">
                            <input type="submit" value="Borrar comentario" class="borrar-btn">
                        </form>';
                    }
            
                echo '</section>';
            }
        ?>
        </section>
    </main>

    <footer>
        <hr>
        <nav>
            <article>
                <p><a href="contacto.php">Contacto 📞</a></p>
            </article>

            <article>
                <p><a href="../Como_se_hizo.pdf">Como se hizo 📦</a></p>
            </article>
        </nav>
    </footer>

</body>
</html>
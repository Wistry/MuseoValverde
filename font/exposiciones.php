<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Valverde - Exposiciones</title>
    <link rel="stylesheet" type="text/css" href="../css/index.css" />
    <link rel="stylesheet" type="text/css" href="../css/exposiciones.css" />
    <script src=" iniciarsesion_validation.js" defer></script>
    <?php
        session_start();
    ?>
</head>

<body>

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

    <main>
        <h1 style="grid-column: 1/4;">Exposiciones Temporales</h1>
        
        <section class="exposicion_temp">
            <h1 style="grid-column: 1/3;">Exposicion Gregorio Prieto - Tríptico<hr></h1>
            <article class="periodoyautores">
                <h2>Periodo: 25/11/2023 - 21/05/2024</h2><hr>
                <article>
                    <h4>Autores:</h4>
                    <ul>
                        <li>Lucía Valverde</li>
                    </ul>
                </article>
            </article>
            <img src="../imagenes/exposicion_temporal1.jpg" class="imagen_exposicion">
            <article>
                <p>En esta exposicion se destaca el arte emplenado en dibujo a grafito y composición digital expresando diferentes emociones de los artistas</p>
                <p>Destacan obras como la de la autora Lucía Valverde con obras como <strong>El olvido como forma de memoria</strong> </p>
            </article>
        </section>

        <section class="exposicion_temp">
            <h1 style="grid-column: 1/3;">Exposicion David Bowie - Editorial<hr></h1>
            <article class="periodoyautores">
                <h2>Periodo: 11/04/2024 - 18/04/2024</h2><hr>
                <article>
                    <h4>Autores:</h4>
                    <ul>
                        <li>Andalusian Studio</li>
                    </ul>
                </article>
            </article>
            <img src="../imagenes/exposicion_temporal2.jpg" class="imagen_exposicion">
            <article>
                <p>En esta exposicion se destaca el emblematico David Bowie mediante diseño grafico para una campaña por su aniversario</p>
                <p>Dicha exposicion realizada por el estudio Andalusian contiene obras como <strong>David Bowie Magazine</strong> </p>
            </article>
        </section>

        <section class="exposicion_temp">
            <h1 style="grid-column: 1/3;">Exposicion Humano - Cuerpos Normativos<hr></h1>
            <article class="periodoyautores">
                <h2>Periodo: 29/04/2024 - 17/08/2024</h2><hr>
                <article>
                    <h4>Autor:</h4>
                    <ul>
                        <li>Luxatus</li>
                    </ul>
                </article>
            </article>
            <img src="../imagenes/exposicion_temporal3.jpg" class="imagen_exposicion">
            <article>
                <p>En esta exposicion se destaca la representacion al desnudo del ser humano en sus diferentes vertientes</p>
                <p>Dicha exposicion realizada por la autora Luxatus contiene obras a grafeno como <strong>Libre</strong> </p>
            </article>
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
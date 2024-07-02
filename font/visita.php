<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Valverde - Visita</title>
    <link rel="stylesheet" type="text/css" href="../css/index.css" />
    <link rel="stylesheet" type="text/css" href="../css/visita.css" />
    <script src=" iniciarsesion_validation.js" defer></script>
    <?php
        session_start();
    ?>
</head>
<!-- Habra sala nebula, sala principal, sala retratos, sala grafito, sala exposiciones temporales -->
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
        <article>
            <h2>Plano del Valverde</h2>
            <img src="../imagenes/plano_museo.jpeg">
        </article>
        <br>

        <section>
            <article class="tipo_sala">
                <article  style="grid-column: 1 / 3;">
                        <h1>Sala principal</h1>
                        <hr>
                </article>
                <img src="../imagenes/sala_principal.jpg" class="imagen_sala">
                <p>Esta sala está formada por las obras más destacadas de la autora Lucía Valverde.
                Dichas obras abarcan lo mejor de cada sección, desde el retrato pasando por la técnicas mixtas hasta el arte a lápiz</p>
            </article>
        </section>
        <br>

        <section>
            <article class="tipo_sala">
                <article  style="grid-column: 1 / 3;">
                        <h1>Sala retrato</h1>
                        <hr>
                </article>
                <img src="../imagenes/sala_retrato.jpg" class="imagen_sala">
                <p>Esta sala está formada por las obras basadas en el retrato.
                Dichas obras abarcan la expresion de diferentes emociones y personas con el afan de trasmitir sentimiento</p>
            </article>
        </section>
        <br>

        <section>
            <article class="tipo_sala">
                <article  style="grid-column: 1 / 3;">
                        <h1>Sala nebula</h1>
                        <hr>
                </article>
                <img src="../imagenes/sala_nebula.jpg" class="imagen_sala">
                <p>Esta sala está formada por las obras basadas en imagenes mas del ambito espaciales
                Dichas obras abarcan la expresion de diferentes gama de colores y arte abstracto</p>
            </article>
        </section>
        <br>

        <section>
            <article class="tipo_sala">
                <article  style="grid-column: 1 / 3;">
                        <h1>Sala grafito</h1>
                        <hr>
                </article>
                <img src="../imagenes/sala_grafito.jpg" class="imagen_sala">
                <p>Esta sala está formada por las obras empleadas mediante la tecnica a destacar de la autora.
                Dichas obras abarcan mayoritariamente el retrato mediante la tecnica del dibujo con grafito</p>
            </article>
        </section>
        <br>
        
        <section>
            <article class="tipo_sala">
                <article  style="grid-column: 1 / 3;">
                        <h1>Sala exposiciones temporales</h1>
                        <hr>
                </article>
                <img src="../imagenes/sala_exposiciones_temporales.png" class="imagen_sala">
                <p>Esta sala está formada por diferentes obras las cuales inspiraron a la autora en su dia.
                Dichas obras abarcan desde arte abstracto a retratos y arte realista</p>
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
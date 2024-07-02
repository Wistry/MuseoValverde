    <!DOCTYPE html>
    <html lang="es">
    
    <head>
        <?php
            session_start();
            include 'db_connect.php'; 
        ?>
        <meta charset="UTF-8">
        <title>Valverde - Contacto</title>
        <link rel="stylesheet" type="text/css" href="../css/index.css" />
        <script src=" iniciarsesion_validation.js" defer></script>  
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
            <article style="text-align: center; margin-top: 10%;">
                <h2>Contacto</h2>
                <p><strong>Desarrollador:</strong> Wistry</p>
                <p><strong>Curso:</strong> 2023/2024 3º A2</p>
                <p><strong>Asignatura:</strong> Programacion Web </p>
                <p><strong>Protagonista:</strong> Lucia Valverde</p>
            </article>
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
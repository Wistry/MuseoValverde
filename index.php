<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    session_start();
    ?>

    <meta charset="UTF-8">
    <title>Museo Valverde</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src=" font/iniciarsesion_validation.js" defer></script>
</head>

<body>
    <?php
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
            <img src="imagenes/logotipo.png" class="logo">
            <nav class="grip-layout">
                <?php
                if (isset($_SESSION['usuario'])) {

                    echo '<div class="welcome-message">';
                        echo '<h3>Bienvenido, ' . htmlspecialchars($_SESSION['usuario']) . '!</h3>'; //Usa htmlspecialchars para evitar inyecciones de codigo EJEMPLO: < --> &lt;
                        echo '<button onclick="location.href=\'font/logout.php\'" type="button">Cerrar sesión</button>'; 
                    echo '</div>';
                } else 
                {
                ?>
                    <form class="Registro" action="font/login.php" method="post">
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
                                onclick="window.location.href='font/altausuario.php'">
                        </article>
                    </form>
                <?php
                }
                ?>

                <article class="Menu">
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="font/coleccion.php">Colección</a></li>
                        <li><a href="font/exposiciones.php">Exposiciones</a></li>
                        <li><a href="font/visita.php">Visita</a></li>
                        <li><a href="font/informacion.php">Información</a></li>
                        <li><a href="font/experiencias.php">Experiencias</a></li>
                    </ul>
                </article>
            </nav>
        </header>
        <hr>
    </section>

    <main style="grid-row: 2; text-align: center; font-size: x-large;">
        <h1>El Valverde</h1>
        <p>El museo de la artista Lucia Valverde</p>
        <?php
            include 'font/db_connect.php';
            $stmt = $conn->prepare("SELECT * FROM Obras");
            $stmt->execute();
            $obras = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="carrusel-container">
            <?php 
                // Obtener una muestra aleatoria de obras para mostrar inicialmente
                $obrasarray = array_rand($obras, 3);
                foreach ($obrasarray as $indice): 
                    $obra = $obras[$indice];
                    $ruta = str_replace('../../', '../', $obra['ruta']);
            ?>
                <div class="carrusel-item">
                    <img src="<?php echo $ruta; ?>">
                </div>
            <?php endforeach; ?>
        </div>

    </main>

    <script>
        const carruselContainer = document.querySelector('.carrusel-container');
        const obras = <?php echo json_encode($obras); ?>; //Obtener las obras

        function updateCarrusel() {
            // Obtener una muestra aleatoria de 3 obras diferentes cada vez
            let indice_actual = Math.floor(Math.random() * (obras.length - 2)); //Obtiene un indice aleatorio de obras, se le resta 2 para que siempre haya 3 obras, por si cogiera el indice final. Con mathfloor se redondea
            const obrasarray = [];
            for (let i = indice_actual; i < indice_actual + 3; i++) {
                obrasarray.push(obras[i]);
            }

            // Eliminar las imágenes actuales
            carruselContainer.innerHTML = '';

            obrasarray.forEach(obra => {
                const ruta = obra['ruta'].replace('../../', '../');
                const newItem = document.createElement('div');
                newItem.classList.add('carrusel-item');
                newItem.innerHTML = `<img src="${ruta}">`;
                carruselContainer.appendChild(newItem);
            });
        }

        setInterval(updateCarrusel, 3000);
        updateCarrusel();

    </script>

    <footer>
        <hr>
        <nav>
            <article>
                <p><a href="font/contacto.php">Contacto 📞</a></p>
            </article>

            <article>
                <p><a href="Como_se_hizo.pdf">Como se hizo 📦</a></p>
            </article>
        </nav>
    </footer>

</body>
</html>


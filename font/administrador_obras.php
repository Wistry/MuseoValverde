<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <title>Museo Valverde</title>
    <link rel="stylesheet" type="text/css" href="../css/administrarobras.css" />
    <link rel="stylesheet" type="text/css" href="../css/index.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="administrador_obras_validation.js" defer></script>
</head>

<body>
    <?php
        // Si hay un mensaje en la sesión, muéstralo con SweetAlert2 y luego elimínalo
        if (isset($_SESSION['mensaje'])) {
            echo "
            <script>
            Swal.fire({
                title: 'Éxito!',
                text: '".$_SESSION['mensaje']."',
                icon: 'success',
                confirmButtonText: 'OK'
            })
            </script>";
            unset($_SESSION['mensaje']);
        }
    ?>

    <section class="header-body">
        <header>
            <h1>MUSEO VALVERDE</h1>
            <img src="../imagenes/logotipo.png" class="logo">
            <nav class="grip-layout">
                <?php
                    echo '<div class="welcome-message">';
                    echo '<h3>Bienvenido, ' . htmlspecialchars($_SESSION['usuario']) . '!</h3>';
                    echo '<button onclick="location.href=\'logout.php\'" type="button">Cerrar sesión</button>';
                    echo '</div>';
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
    

    <main style="grid-row: 2;  font-size: x-large;">

        <!-- Formulario para añadir una obra -->
        <section class="aniadirobra">
            <h2>Añadir obra</h2>
            <hr>
            <form id="form-aniadir-obra" action="add_obra.php" method="post" enctype="multipart/form-data">
                <label for="titulo">Título:</label>
                <input type="text" id="tituloaniadir" name="titulo">
                <label for="autor">Autor:</label>
                <input type="text" id="autoraniadir" name="autor">
                <label for="fecha">Fecha:</label>
                <input type="text" id="fechaaniadir" name="fecha">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcionaniadir" name="descripcion"></textarea>
                <label for="ruta">Foto obra:</label>
                <input list="rutas" id="rutaaniadir" name="ruta">
                <datalist id="rutas">
                    <?php
                        // Ruta de la carpeta que deseas mostrar
                        $ruta_carpeta = '../../imagenes';

                        // Obtener la lista de archivos en la carpeta
                        $archivos = scandir($ruta_carpeta);

                        // Mostrar la lista de archivos
                        foreach ($archivos as $archivo) {
                            // Ignorar los directorios especiales '.' y '..'
                            if ($archivo != '.' && $archivo != '..') {
                                echo "<option value=\"$ruta_carpeta/$archivo\">$archivo</option>";
                            }
                        }
                    ?>
                </datalist>
                <label for="coleccion">Colección:</label>
                <select id="coleccion" name="coleccion">
                    <?php
                    include 'db_connect.php';

                    $sql = "SELECT id, titulo FROM Colecciones";
                    $result = $conn->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . $row["id"] . "\">" . $row["titulo"] . "</option>";
                        }
                    } else {
                        echo "<option value=\"\">No hay colecciones disponibles.</option>";
                    }

                    $conn = null; // Cierra la conexión a la base de datos
                    ?>
                </select>
                <label for="tema">Tema:</label>
                <input type="text" id="temaaniadir" name="tema">
                <input type="submit" value="Añadir obra">
            </form>
        </section>

        <!-- Formulario para modificar una obra -->
        <section class="modificarobra">
            <h2>Modificar obra</h2>
            <hr>
            <form id="form-modificar-obra" action="modify_obra.php" method="post">
                <label for="titulo_original">Título original de la obra a modificar:</label>
                <select id="titulo_original" name="titulo_original">
                    <?php
                    include 'db_connect.php';

                    $sql = "SELECT titulo FROM Obras";
                    $result = $conn->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . $row["titulo"] . "\">" . $row["titulo"] . "</option>";
                        }
                    } else {
                        echo "<option value=\"\">No hay obras disponibles.</option>";
                    }

                    $conn = null; // Cierra la conexión a la base de datos
                    ?>
                </select>
                <label for="titulo">Título nuevo:</label>
                <input type="text" id="titulo" name="titulo">
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor">
                <label for="fecha">Fecha:</label>
                <input type="text" id="fecha" name="fecha">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
                <label for="ruta">Foto obra:</label>
                <input list="rutas" id="ruta" name="ruta">
                <datalist id="rutas">
                    <?php
                        // Ruta de la carpeta que deseas mostrar
                        $ruta_carpeta = '../../imagenes';

                        // Obtener la lista de archivos en la carpeta
                        $archivos = scandir($ruta_carpeta);

                        // Mostrar la lista de archivos
                        foreach ($archivos as $archivo) {
                            // Ignorar los directorios especiales '.' y '..'
                            if ($archivo != '.' && $archivo != '..') {
                                echo "<option value=\"$ruta_carpeta/$archivo\">$archivo</option>";
                            }
                        }
                    ?>
                </datalist>
                <label for="coleccion">Colección:</label>
                <select id="coleccion" name="coleccion">
                    <?php
                    include 'db_connect.php';

                    $sql = "SELECT id, titulo FROM Colecciones";
                    $result = $conn->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . $row["id"] . "\">" . $row["titulo"] . "</option>";
                        }
                    } else {
                        echo "<option value=\"\">No hay colecciones disponibles.</option>";
                    }

                    $conn = null; // Cierra la conexión a la base de datos
                    ?>
                </select>
                <label for="tema">Tema:</label>
                <input type="text" id="tema" name="tema">
                <input type="submit" value="Modificar obra">
            </form>
        </section>

        <!-- Formulario para eliminar una obra -->
        <section>
            <h2>Eliminar obra</h2>
            <hr>
            <form action="delete_obra.php" method="post">
                <label for="tituloEliminar">Título obra a eliminar</label>
                    <select id="tituloEliminar" name="titulo" onchange="updateImageEliminar()">
                        <?php
                        include 'db_connect.php';

                        $sql = "SELECT titulo, ruta FROM Obras";
                        $result = $conn->query($sql);

                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $imagePath = $row["ruta"]; // Utilizar la URL almacenada en la base de datos
                                echo "<option value=\"" . $row["titulo"] . "|" . $imagePath . "\">" . $row["titulo"] . "</option>";
                            }
                        } else {
                            echo "<option value=\"\">No hay obras disponibles.</option>";
                        }

                        $conn = null; // Cierra la conexión a la base de datos
                        ?>
                    </select>
                    <img id="obraImageEliminar" src="" alt="Imagen de la obra seleccionada" style="max-width: 100%;">
                    <input type="submit" value="Eliminar obra">
                </form>
            </section>

            <script>
            window.onload = function() {
                updateImageEliminar();
            }
            function updateImageEliminar() {
                var selectElement = document.getElementById('tituloEliminar');
                var selectedOption = selectElement.options[selectElement.selectedIndex];
                var titleAndImage = selectedOption.value.split('|');
                var title = titleAndImage[0];
                var image = titleAndImage[1];

                document.getElementById('obraImageEliminar').src = image;
            }
            </script>

    </main>

    <footer>
        <hr>
        <nav>
            <article>
                <p><a href="contacto.html">Contacto 📞</a></p>
            </article>

            <article>
                <p><a href="Como_se_hizo.pdf">Como se hizo 📦</a></p>
            </article>
        </nav>
    </footer>

</body>
</html>

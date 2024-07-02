<!DOCTYPE html>
<html lang="es">

<head>
    <?php
        // Inicia la sesión
        session_start();
        include 'db_connect.php'; 
    ?>

    <meta charset="UTF-8">
    <title>Valverde - Colección Un Mismo Destino</title>
    <link rel="stylesheet" type="text/css" href="../css/index.css" />
    <link rel="stylesheet" type="text/css" href="../css/coleccion.css" />
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
                        echo '<h3 style="grid-row: 1/3; grid-column: 1;">Bienvenido, ' . htmlspecialchars($_SESSION['usuario']) . '!</h3>';
                        echo '<button onclick="location.href=\'logout.php\'" type="button">Cerrar sesión</button>';
                        if($_SESSION['usuario'] == 'admin'){
                            echo '<button onclick="location.href=\'administrador_obras.php\'" type="button">Administrar obras</button>';
                        }
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
        <p class="espacio"></p>
        
        <section class="menu_obras">
            <section class="autores">
                <h2 class="nombreSeccion">Autores</h2>
                <hr>
                <ul class="menu_desplegable">
                    <?php
                    // Obtener parámetros de la URL
                    $selected_autores = isset($_GET['autor']) ? $_GET['autor'] : [];

                    if (!is_array($selected_autores)) {
                        $selected_autores = [$selected_autores];
                    }

                    // Consulta SQL para obtener todos los autores distintos de la tabla Obras
                    $sql = "SELECT DISTINCT autor FROM Obras";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $autores = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    // Generar checkboxes para cada autor
                    foreach ($autores as $autor) {
                        $autor_escaped = htmlspecialchars($autor);
                        $checked = in_array($autor, $selected_autores) ? 'checked' : '';
                        echo '<li><label><input type="checkbox" name="autor" value="' . $autor_escaped . '" ' . $checked . '>' . $autor_escaped . '</label></li>';
                    }
                    ?>
                </ul>
            </section>

            <section class="temas">
                <hr>
                <h2 class="nombreSeccion">Temas</h2>
                <hr>
                <ul class="menu_desplegable">
                    <?php
                    $selected_temas = isset($_GET['tema']) ? $_GET['tema'] : [];

                    if (!is_array($selected_temas)) {
                        $selected_temas = [$selected_temas];
                    }

                    $sql = "SELECT DISTINCT tema FROM Obras";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $temas = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    foreach ($temas as $tema) {
                        $tema_escaped = htmlspecialchars($tema);
                        $checked = in_array($tema, $selected_temas) ? 'checked' : '';
                        echo '<li><label><input type="checkbox" name="tema" value="' . $tema_escaped . '" ' . $checked . '>' . $tema_escaped . '</label></li>';
                    }
                    ?>
                </ul>
            </section>

            <section class="anios">
                <hr>
                <h2 class="nombreSeccion">Años</h2>
                <hr>
                <ul class="menu_desplegable">
                    <?php
                    $selected_anios = isset($_GET['anio']) ? $_GET['anio'] : [];

                    if (!is_array($selected_anios)) {
                        $selected_anios = [$selected_anios];
                    }

                    $sql = "SELECT DISTINCT anio FROM Obras";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $anios = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    foreach ($anios as $anio) {
                        $anio_escaped = htmlspecialchars($anio);
                        $checked = in_array($anio, $selected_anios) ? 'checked' : '';
                        echo '<li><label><input type="checkbox" name="anio" value="' . $anio_escaped . '" ' . $checked . '>' . $anio_escaped . '</label></li>';
                    }
                    ?>
                </ul>
            </section>
            <button id="filterButton">Aplicar Filtros</button>
            <button id="clearButton">Borrar Filtros</button>
        </section>

        <?php
            // Obtener el ID de la última obra mostrada si está presente, de lo contrario establecerlo en 0
            $ultimo_id = isset($_GET['ultimo_id']) ? intval($_GET['ultimo_id']) : 0;
            $coleccion_id = isset($_GET['coleccion_id']) ? intval($_GET['coleccion_id']) : null;
            $anio = isset($_GET['anio']) ? $_GET['anio'] : null;
            $tema = isset($_GET['tema']) ? $_GET['tema'] : null;
            $autor = isset($_GET['autor']) ? $_GET['autor'] : null;

            // Construir la consulta SQL base
            $sql = "SELECT * FROM Obras WHERE 1=1"; //1*1 Para falicitar la construccion dinamica de la consulta

            // Agregar condiciones según los parámetros recibidos
            if ($coleccion_id !== null) {
                $sql .= " AND coleccion_id = :coleccion_id";
            }
            if ($anio !== null) {
                $sql .= " AND anio = :anio";
            }
            if ($tema !== null) {
                $sql .= " AND tema = :tema";
            }
            if ($autor !== null) {
                $sql .= " AND autor = :autor";
            }

            // Agregar la condición para la paginación
            if ($ultimo_id == 0) {
                $sql .= " ORDER BY id ASC LIMIT 9";
            } else {
                $sql .= " AND id > :ultimo_id ORDER BY id ASC LIMIT 9";
            }

            // Preparar la consulta
            $stmt = $conn->prepare($sql);

            // Vincular los parámetros a la consulta
            if ($coleccion_id !== null) {
                $stmt->bindParam(':coleccion_id', $coleccion_id, PDO::PARAM_INT);
            }
            if ($anio !== null) {
                $stmt->bindParam(':anio', $anio, PDO::PARAM_STR);
            }
            if ($tema !== null) {
                $stmt->bindParam(':tema', $tema, PDO::PARAM_STR);
            }
            if ($autor !== null) {
                $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
            }
            if ($ultimo_id !== 0) {
                $stmt->bindParam(':ultimo_id', $ultimo_id, PDO::PARAM_INT);
            }

            $stmt->execute();

            // Obtener las obras siguientes
            $obras_siguientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($obras_siguientes)) {
                $ultimo_obra = end($obras_siguientes);
                $ultimo_id = $ultimo_obra['id'];
            }
        ?>

        <script>
            document.getElementById('filterButton').addEventListener('click', function() {
                let params = new URLSearchParams(window.location.search);

                document.querySelectorAll('.menu_obras input[type="checkbox"]').forEach(function(checkbox) {
                    if (checkbox.checked) {
                        params.append(checkbox.name, checkbox.value);
                    } else {
                        params.delete(checkbox.name, checkbox.value);
                    }
                });

                window.location.href = 'coleccion_generica.php?' + params.toString();
            });
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.menu_obras section').forEach(function(section) {
                    section.querySelector('h2').addEventListener('click', function() {
                        section.classList.toggle('menu_visible');
                    });
                });
                document.getElementById('clearButton').addEventListener('click', function() {
                    // Eliminar todos los parámetros de la URL relacionados con los filtros
                    var url = new URL(window.location.href);
                    url.searchParams.delete('autor');
                    url.searchParams.delete('tema');
                    url.searchParams.delete('anio');
                    
                    // Recargar la página con la URL modificada
                    window.location.href = url.toString();
                });
            });
        </script>

        
        <section class="conjunto_obras">
            <?php if (empty($obras_siguientes)): ?>
                <div class="noobras">
                    <h2>No hay obras disponibles con los filtros seleccionados.</h2>
                </div>
            <?php else: ?>
                <?php foreach ($obras_siguientes as $obra): ?>
                    <article class="obra" data-obra='<?php echo json_encode($obra); ?>'>
                        <a href="detalle_obra.php?id=<?php echo $obra['id']; ?>">
                            <img src="<?php echo $obra['ruta']; ?>" class="imagen">
                        </a>
                    </article>
                <?php endforeach; ?>
                <article class="botones">
                    <button onclick="AnteriorPag()">Pagina Anterior</button>
                    <button onclick="SiguientePag()">Siguiente Pagina</button>
                </article>
            <?php endif; ?>
        </section>

        <script>
            function SiguientePag() {
                // Obtiene los parámetros actuales de la URL
                const urlParams = new URLSearchParams(window.location.search);
                const ultimoId = <?php echo json_encode($ultimo_id); ?>;
                
                const id = urlParams.get('coleccion_id');
                const autor = urlParams.get('autor');
                const tema = urlParams.get('tema');
                const anio = urlParams.get('anio');

                // Construye la nueva URL con el parámetro 'ultimo_id'
                let nuevaURL = 'coleccion_generica.php?ultimo_id=' + ultimoId;

                // Verificar si hay un 'coleccion_id' en la URL y agregarlo a la nueva URL si es así
                if (id !== null) {
                    nuevaURL += '&' + 'coleccion_id=' + id;
                }
                if (autor !== null) {
                    nuevaURL += '&' + 'autor=' + autor;
                }
                if (tema !== null) {
                    nuevaURL += '&' + 'tema=' + tema;
                }
                if (anio !== null) {
                    nuevaURL += '&' + 'anio=' + anio;
                }



                // Redirige a la nueva URL
                window.location.href = nuevaURL;
            }
            function AnteriorPag() {
                // Obtiene los parámetros actuales de la URL
                const urlParams = new URLSearchParams(window.location.search);
                let ultimoId = <?php echo json_encode($ultimo_id); ?>;

                const id = urlParams.get('coleccion_id');
                const autor = urlParams.get('autor');
                const tema = urlParams.get('tema');
                const anio = urlParams.get('anio');

                ultimoId = ultimoId - 12; // 9 + 1 (para compensar el último ID mostrado) + 1 (para retroceder 1 página) + 1 (para compensar el límite de la consulta el simbolo < en vez de <=)

                // Construye la nueva URL con el parámetro 'ultimo_id'
                let nuevaURL = 'coleccion_generica.php?ultimo_id=' + ultimoId;

                if (id !== null) {
                    nuevaURL += '&' + 'coleccion_id=' + id;
                }
                if (autor !== null) {
                    nuevaURL += '&' + 'autor=' + autor;
                }
                if (tema !== null) {
                    nuevaURL += '&' + 'tema=' + tema;
                }
                if (anio !== null) {
                    nuevaURL += '&' + 'anio=' + anio;
                }

                // Redirige a la nueva URL
                window.location.href = nuevaURL;
            }
            document.addEventListener('DOMContentLoaded', function() {
                const mostrarMensaje = function(event) {
                    // Obtener los datos de la obra desde el atributo de datos
                    const obraData = JSON.parse(event.target.closest('.obra').dataset.obra);
                    const titulo = obraData.titulo;
                    const tema = obraData.tema; // Asegúrate de que 'tema' esté disponible en tus datos
                    const autor = obraData.autor;

                    // Crear y mostrar la ventana emergente
                    const ventanaEmergente = document.createElement('div');
                    ventanaEmergente.classList.add('ventana-emergente');

                    // Crear elementos HTML para el título y el tema
                    const tituloElemento = document.createElement('p');
                    tituloElemento.innerHTML = '<strong>Título:</strong> ' + titulo;

                    const temaElemento = document.createElement('p');
                    temaElemento.innerHTML = '<strong>Tema:</strong> ' + tema;

                    const autorElemento = document.createElement('p');
                    autorElemento.innerHTML = '<strong>Autor:</strong> ' + autor;

                    // Agregar los elementos al popup
                    ventanaEmergente.appendChild(tituloElemento);
                    ventanaEmergente.appendChild(temaElemento);
                    ventanaEmergente.appendChild(autorElemento);

                    document.body.appendChild(ventanaEmergente);

                    // Posicionar la ventana emergente cerca de la imagen
                    ventanaEmergente.style.top = (event.target.offsetTop + event.target.offsetHeight) + 'px';
                    ventanaEmergente.style.left = event.target.offsetLeft + 'px';

                    event.target.addEventListener('mouseout', function() {
                        ventanaEmergente.remove();
                    });
                };

                document.querySelectorAll('.obra .imagen').forEach(function(imagen) {
                    imagen.addEventListener('mouseover', mostrarMensaje);
                });
            });


        </script>
        <p class="espacio"></p>
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
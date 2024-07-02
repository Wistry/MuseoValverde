<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    // Inicia la sesión
    session_start();
    include 'db_connect.php'; 
    ?>

    <meta charset="UTF-8">
    <title>Valverde - Colección</title>
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
                        $selected_autores = isset($_GET['autor']) ? $_GET['autor'] : []; //Para saber si ya hay algun autor en el filtro

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
                            $autor_escaped = htmlspecialchars($autor); //Se usa para prevenir la inyeccion de codigo de hay el escaped
                            $checked = in_array($autor, $selected_autores) ? 'checked' : ''; //Comprobamos si el autor no habia sido antes seleccionado/ En caso de que si lo marcamos
                            echo "<li><label><input type='checkbox' name='autor' value='$autor_escaped' $checked>$autor_escaped</label></li>";
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
                            echo "<li><label><input type='checkbox' name='tema' value='$tema_escaped' $checked>$tema_escaped</label></li>";
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
                            echo "<li><label><input type='checkbox' name='anio' value='$anio_escaped' $checked>$anio_escaped</label></li>";
                        }
                    ?>
                </ul>
            </section>
            <button id="filterButton">Aplicar Filtros</button>
            <button id="clearButton">Borrar Filtros</button>
        </section>

        <?php
            $stmt = $conn->prepare("SELECT * FROM Colecciones");
            $stmt->execute();
            $colecciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <section class="conjunto_obras">
            <?php foreach ($colecciones as $coleccion): ?>
                <article class="obra" data-obra='<?php echo json_encode($coleccion); //Añadimos el atributo data-obra con los datos de la obra ?>'> 
                    <a href="coleccion_generica.php?coleccion_id=<?php echo $coleccion['id']; ?>&ultimo_id=0"> 
                        <img src="<?php echo $coleccion['ruta']; ?>" class="imagen">
                    </a>    
                </article>
            <?php endforeach; ?>
        </section>
    
        <p class="espacio"></p>
    
        <script>
            //Funcion para filtrar las obras segun el checkbox seleccionado
            document.getElementById('filterButton').addEventListener('click', function() {
                let params = new URLSearchParams(window.location.search);

                document.querySelectorAll('.menu_obras input[type="checkbox"]').forEach(function(checkbox) {
                    if (checkbox.checked) {
                        params.append(checkbox.name, checkbox.value); //Si esta marcado añadimos el valor del checkbox
                    } else {
                        params.delete(checkbox.name, checkbox.value); 
                    }
                });

                window.location.href = 'coleccion_generica.php?' + params.toString(); //Los parametros marcados los añadimos a la URL
            });

            //Tras cargar la pagina puedo ejecutar estas 2 funciones
            document.addEventListener('DOMContentLoaded', function() {
                
                //Funcion para que al darle click alterne la clase del menu, añade o no menu_visible , controlado por css
                document.querySelectorAll('.menu_obras section').forEach(function(section) {
                    section.querySelector('h2').addEventListener('click', function() {
                        section.classList.toggle('menu_visible');
                    });
                });
                
                //Limpia el filtro de busqueda segun autor/tema/año conlleva ir a coleccion.
                document.getElementById('clearButton').addEventListener('click', function() {
                    // Eliminar todos los parámetros de la URL relacionados con los filtros
                    let url = new URL(window.location.href);
                    url.searchParams.delete('autor');
                    url.searchParams.delete('tema');
                    url.searchParams.delete('anio');
                    
                    // Recargar la página con la URL modificada
                    window.location.href = url.toString();
                });
            });

            //Segunda funcion tras cargar la pagina
            document.addEventListener('DOMContentLoaded', function() {
                const mostrarMensaje = function(event) {
                    // Obtener los datos de la obra desde el atributo de datos
                    const obraData = JSON.parse(event.target.closest('.obra').dataset.obra);
                    const titulo = obraData.titulo;
                    const autor = obraData.autor; 

                    // Crear y mostrar la ventana emergente
                    const ventanaEmergente = document.createElement('div');
                    ventanaEmergente.classList.add('ventana-emergente');

                    // Crear elementos HTML para el título y el tema
                    const tituloElemento = document.createElement('p');
                    tituloElemento.innerHTML = '<strong>Coleccion:</strong> ' + titulo;

                    const autorElemento = document.createElement('p');
                    autorElemento.innerHTML = '<strong>Artista coleccion:</strong> ' + autor;

                    // Agregar los elementos al popup
                    ventanaEmergente.appendChild(tituloElemento);
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

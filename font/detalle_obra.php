<!DOCTYPE html>
<html lang="es">

<head>
    <?php
            session_start();
            include 'db_connect.php'; 
        ?>
    <meta charset="UTF-8">
    <title>Valverde - Obra - Un mismo Destino</title>
    <link rel="stylesheet" type="text/css" href="../css/index.css" />
    <link rel="stylesheet" type="text/css" href="../css/obra.css" />
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
                        echo '<button onclick="location.href=\'administrador_obras.php\'" type="button">Administrar obras</button>';
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
    
    <?php
        if(isset($_GET['id'])) {

            $obra_id = $_GET['id'];
            include 'db_connect.php';

            $stmt = $conn->prepare("SELECT * FROM Obras WHERE id = :obra_id");
            $stmt->bindParam(':obra_id', $obra_id);
            $stmt->execute();

            $obra = $stmt->fetch(PDO::FETCH_ASSOC);
            if($obra) {
    ?>
        <main> 
            <img src="<?php echo $obra['ruta']; ?>" class="obra">
            <section class="fichatecnica">
                <h1><?php echo $obra['titulo']; ?></h1>
                <article style="grid-row: 1/5; grid-column: 2;">
                    <h3>Enlaces de interes</h3>
                    <ul>
                        <li><a href="">Lucia Valverde</a></li>
                        <li><a href="">Luxatus</a></li>
                        <li><a href="">Andalusian Estudio</a></li>
                    </ul>
                    <h3>Año</h3>
                    <ul><li><?php echo $obra['anio']?></li></ul>
                    <h3>Tema</h3>
                    <ul><li><?php echo $obra['tema']?></li></ul>
                </article>
                <h3><?php echo $obra['autor']; ?></h3>
                <p style="color: rgb(235, 215, 215);"><?php echo date('d/m/Y', strtotime($obra['fecha'])); ?></p>
                <p><?php echo $obra['descripcion']; ?></p>
            </section>
        </main>
        <?php
        } else {
            // Si no se encuentra la obra, mostrar un mensaje de error
            echo "No se encontró la obra.";
        }
    } else {
        // Si no se proporciona un ID de obra en la URL, mostrar un mensaje de error
        echo "ID de obra no especificado.";
    }
    ?>

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
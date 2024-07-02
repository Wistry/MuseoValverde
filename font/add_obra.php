<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connect.php'; // Conexión a la base de datos
    try {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $ruta = $_POST['ruta'];
        $coleccion_id = $_POST['coleccion'];
        $tema = $_POST['tema'];

        $año = date('Y', strtotime($fecha));

        $stmt = $conn->prepare("INSERT INTO Obras (titulo, autor, fecha, descripcion, ruta, coleccion_id, anio, tema) VALUES (:titulo, :autor, :fecha, :descripcion, :ruta, :coleccion_id, :anio, :tema)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':ruta', $ruta);
        $stmt->bindParam(':coleccion_id', $coleccion_id);
        $stmt->bindParam(':anio', $año);    
        $stmt->bindParam(':tema', $tema);
        $stmt->execute();

        // Almacenar el mensaje de éxito en la sesión
        $_SESSION['mensaje'] = "Obra $titulo añadida con éxito";

        header('Location: administrador_obras.php');
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar obra: " . $e->getMessage();
    }
} 
?>
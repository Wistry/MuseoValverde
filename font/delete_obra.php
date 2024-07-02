<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connect.php';
    try{   
        $tituloYRuta = $_POST['titulo'];
        $titulo = explode("|", $tituloYRuta)[0];

        $sql = "DELETE FROM Obras WHERE titulo = :tituloEliminar";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':tituloEliminar', $titulo);
        $stmt->execute();

        // Almacenar el mensaje de éxito en la sesión
        $_SESSION['mensaje'] = "Obra $titulo eliminada con éxito ";

        header('Location: administrador_obras.php');
        exit();
    }catch(PDOException $e) {
        echo "Error al borrar obra: " . $e->getMessage();
    }

}
?>
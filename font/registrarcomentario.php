<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connect.php';

    try {
        $nombre_usuario = $_SESSION['usuario'];
        $comentario = $_POST['comentario'];

        $stmt = $conn->prepare("INSERT INTO Comentarios (usuario, comentario) VALUES (:usuario, :comentario)");
        $stmt->bindParam(':usuario', $nombre_usuario);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->execute();

        header('Location: experiencias.php');
        exit();
    } catch(PDOException $e) {
        echo "Error al insertar comentario: " . $e->getMessage();
    } finally {
        $conn = null;
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>

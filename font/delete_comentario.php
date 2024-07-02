<?php

try {
    include 'db_connect.php'; // Conexión a la base de datos

    $idComentario = $_POST['comment_id'];

    $consultaSQL = "DELETE FROM Comentarios WHERE id = :id";
    $stmt = $conn->prepare($consultaSQL);
    $stmt->bindParam(':id', $idComentario);
    $stmt->execute();

    header('Location: experiencias.php');
    exit;
}
catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
<?php
session_start();

try {
    include 'db_connect.php'; // Conexión a la base de datos

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    if ($contrasena !== $confirmar_contrasena) {
        exit;
    }

    // Consultar si el usuario ya existe
    $consultaUsuario = "SELECT * FROM Usuarios WHERE usuario = :usuario"; //Se usa esto para prevenir inyecciones de codigo
    $stmtUsuario = $conn->prepare($consultaUsuario);
    $stmtUsuario->bindParam(':usuario', $usuario);
    $stmtUsuario->execute();
    $resultadoUsuario = $stmtUsuario->fetch();

    if ($resultadoUsuario) {
        $_SESSION['mensajeError'] = "El nombre de usuario ya está en uso. Por favor, elija otro nombre de usuario.";
        header('Location: altausuario.php'); 
        exit;
    }

    $consultaSQL = "INSERT INTO Usuarios (nombre, usuario, contrasena, email, telefono) VALUES (:nombre, :usuario, :contrasena, :email, :telefono)";

    $stmt = $conn->prepare($consultaSQL);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);

    $stmt->execute();

    header('Location: ../index.php');
    $_SESSION['usuario'] = $usuario;

    exit;
} 
catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
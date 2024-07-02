<?php
session_start();


try {
    include 'db_connect.php'; // Conexión a la base de datos

    $nombreUsuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $consultaSQL = "SELECT * FROM Usuarios WHERE usuario = :usuario";
    $stmt = $conn->prepare($consultaSQL);
    $stmt->bindParam(':usuario', $nombreUsuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($contrasena == $user['contrasena']) {
            // Almacenar los datos del usuario en la sesión
            $_SESSION['usuario'] = $user['usuario'];

        } else {
            $_SESSION['mensajeini'] = "La contraseña es incorrecta.";
        }
    } 
    else {
        $_SESSION['mensajeini'] = "El usuario no existe";
    }
    
    if (strpos($_SERVER['REQUEST_URI'], '/font/') !== false) { //Si dentro esta en la carpeta font
        header('Location: ../index.php');
        exit;
    } else {
        header('Location: index.php');
        exit;
    }
} 
catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
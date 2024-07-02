<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connect.php';
    try{
        $titulo_original = $_POST['titulo_original'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $ruta = $_POST['ruta'];
        $coleccion = $_POST['coleccion']; 
        $tema = $_POST['tema']; 
    
        $sql = "UPDATE Obras SET ";
        $params = array();
    
        if (!empty($titulo)) {
            $sql .= "titulo=?, ";
            array_push($params, $titulo);
        }
        if (!empty($autor)) {
            $sql .= "autor=?, ";
            array_push($params, $autor);
        }
        if (!empty($fecha)) {
            $fecha = date('Y-m-d', strtotime(str_replace('-', '/', $fecha)));
            $sql .= "fecha=?, ";
            array_push($params, $fecha);
        }
        if (!empty($descripcion)) {
            $sql .= "descripcion=?, ";
            array_push($params, $descripcion);
        }
        if (!empty($ruta)) {
            $sql .= "ruta=?, ";
            array_push($params, $ruta);
        }
        if (!empty($coleccion)) {
            $sql .= "coleccion_id=?, "; 
            array_push($params, $coleccion);
        }
        if (!empty($tema)) {
            $sql .= "tema=?, ";
            array_push($params, $tema);
        }
    
        // Eliminar la última coma y espacio, sino da error
        $sql = rtrim($sql, ", ");
    
        $sql .= " WHERE titulo=?";
        array_push($params, $titulo_original);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        // Almacenar el mensaje de éxito en la sesión
        $_SESSION['mensaje'] = "Obra  $titulo_original modificada con éxito";

        header('Location: administrador_obras.php');
        exit();
    } catch(PDOException $e) {
        echo "Error al modificar obra: " . $e->getMessage();
    }
}
?>

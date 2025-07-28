<?php

session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado. Debes iniciar sesión como administrador.");

$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$ruta = null;

if ($_FILES['video']['error'] === UPLOAD_ERR_OK){
    $nombre = time() . '_' . $_FILES['video']['name'];
    $ruta = 'uploads/nombre' . $nombre;
    move_uploaded_file($_FILES['video']['tmp_name'], $ruta);


    $sql = "UPDATE videos SET descripcion = ?, ruta_video = ? WHERE id = ?";
    $conexion = new mysqli("localhost", "root", "Esognare2020.", "yuliana");
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $descripcion, $ruta, $id);

}else{
    $sql = "UPDATE videos SET descripcion = ? WHERE id = ?";
    $conexion = new mysqli("localhost", "root", "Esognare2020.", "yuliana");
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $descripcion, $id);
}

    $stmt->execute();
    $stmt->close();

    header("Location: admin.php");
} else {
    die("Acceso denegado. Debes iniciar sesión como administrador.");
}

 

<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    die("Acceso denegado. Debes iniciar sesión como administrador.");
}

$descripcion = $_POST['descripcion'];
$ruta = null;

if ($_FILES['video']['error'] === UPLOAD_ERR_OK){
    $nombre = time() . '_' . $_FILES['video']['name'];
    $ruta = 'uploads/' . $nombre;

    if (!file_exists('uploads/videos')) {
        mkdir('uploads/videos', 0777, true);
    }
    move_uploaded_file($_FILES['video']['tmp_name'], $ruta);

}

$conexion = new mysqli("localhost", "root", "Esognare2020.", "yuliana");    
$stmt = $conexion->prepare("INSERT INTO videos (descripcion, ruta_video) VALUES (?, ?)");
$stmt->bind_param("ss", $descripcion, $ruta);
$stmt->execute();
$stmt->close();

header("Location: admin.php");

<?php

session_start();
if ($_SESSION['rol'] !== 'admin') 
    die("Acceso denegado. Debes iniciar sesión como administrador.");

$id = $_GET['id'];
$conexion = new mysqli("localhost", "root", "Esognare2020.", "yuliana");

//Lo que haremos es eliminar el video de la base de datos y del servidor

$video = $conexion->query("SELECT * FROM videos WHERE id = $id")->fetch_assoc();
if ($video && file_exists($video['ruta_video'])) {
    unlink($video['ruta_video']); // Eliminar el archivo del servidor
}

$conexion->query("DELETE FROM videos WHERE id = $id");
header("Location: admin.php");
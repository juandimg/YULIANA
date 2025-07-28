<?php 
session_start();
if ($_SESSION['rol'] !== 'admin') 
    die("Acceso denegado. Debes iniciar sesión como administrador.");

$id = $_GET['id'] ;
$conexion = new mysqli("localhost", "root", "Esognare2020.", "yuliana");
$video = $conexion->query("SELECT * FROM videos WHERE id = $id")->fetch_assoc();

?>

<h2>Editar el Video</h2>

<form action="actualizar_video.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $video['id'] ?>">
    <label for="">Descripción</label>
    <textarea name="descripcion" rows="4" cols="50"><?= htmlspecialchars($video['descripcion']) ?></textarea>

    <label for="">Subir nuevo video (opcional)</label>
    <input type="file" name="video" accept="video/*">

    <button type="submit">Actualizar Video</button>
    </form>
<?php

session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin'){
    die("Acceso denegado. Debes iniciar sesión como administrador.");
}

$conexion = new mysqli("localhost", "root", "Esognare2020.", "yuliana");
$resultado = $conexion->query("SELECT * FROM videos ORDER BY fecha_subida DESC");
?>

<h2>Menu Administrador</h2>

<form action="guardar_video.php" method="POST" enctype="multipart/form-data">
    <label for="">Descripción</label>
    <textarea name="descripcion" rows="4" cols="50" id=""></textarea>

    <label for="">Subir video</label>
    <input type="file" name="video" accept="video/*" >

    <button type="submit">Subir Video</button>
</form> 


<hr>
<h3>Videos existentes:</h3>

<?php while ($row = $resultado->fetch_assoc()): ?>
   <div style="border: 1px solid #ccc; padding : 10px; margin-bottom: 20px;">
    <p><?= htmlspecialchars($row['descripcion']) ?></p>
    <video width="320" height="240" controls>
        <source src="<?= $row['ruta_video'] ?>" type="video/mp4">
        </video>

        <a href="editar_video.php?id=<?= $row['id'] ?>">Editar</a> | 
        <a href="eliminar_video.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar este video?')">Eliminar</a>
    </div>
<?php endwhile; ?>

<a href="cerrar_sesion.php">Cerrar sesión</a>
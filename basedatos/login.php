<?php
//Esta se dirige a inicio//login.php

$servername = "localhost";
$username = "root";
$password = "Esognare2020.";
$dbname = "yuliana";



// Aca lo que hago es crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

//Verifico la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST['email']) || empty($_POST['contraseña']) || empty($_POST['nombre']) || empty($_POST['rol'])) {
        die("Por favor, completa todos los campos.");
    }

    $email = $_POST['email'];
    $password = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $nombre = $_POST['nombre'];

    // Reviso que el correo exista
    $check_sql = "SELECT * FROM usuarios WHERE email = ?";
    $check_stmt = $conn-> prepare ($check_sql);
    if ($check_stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        die("El correo ya está registrado.");
    }

    // Inserto el nuevo usuario
   $insert_sql = "INSERT INTO usuarios (email, contraseña, nombre, rol) VALUES (?, ?,
    ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssss", $email, $password, $nombre, $_POST['rol']);
    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso.'); window.location.href = '../inicio/inicio.html';</script>";
    } else {
        die("Error al registrar el usuario: " . $stmt->error);
    }
}

$conn->close();
?>


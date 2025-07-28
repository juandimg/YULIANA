<?php
$servername = "localhost";
$username = "root";
$password = "Esognare2020.";
$dbname = "yuliana";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de campos
   if (empty($_POST['email']) || empty($_POST['nombre']) || empty($_POST['contraseña']) || empty($_POST['confirmar'])) {
    die("Por favor, completa todos los campos.");
}

    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];
    $confirmar = $_POST['confirmar'];

    // Validación de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("El correo no es válido.");
    }

    // Confirmación de contraseña
    if ($contraseña !== $confirmar) {
        die("Las contraseñas no coinciden.");
    }

    // Hashear la contraseña
    $passwordHash = password_hash($contraseña, PASSWORD_DEFAULT);

    // Definir rol automático
    $adminsPermitidos = ['admin1@gmail.com', 'yulianaadmin@gmail.com'];
    $rol = in_array($email, $adminsPermitidos) ? 'admin' : 'usuario';

    // Verificar si ya existe el correo
    $check_sql = "SELECT * FROM usuarios WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    if ($check_stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        die("El correo ya está registrado.");
    }

    // Insertar el usuario
    $insert_sql = "INSERT INTO usuarios (email, contraseña, nombre, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    if ($stmt === false) {
        die("Error al preparar la inserción: " . $conn->error);
    }

    $stmt->bind_param("ssss", $email, $passwordHash, $nombre, $rol);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso.'); window.location.href = '../inicio/inicio.html';</script>";
    } else {
        die("Error al registrar el usuario: " . $stmt->error);
    }
}

$conn->close();
?>
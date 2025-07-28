<?php

$servername = "localhost";
$username = "root";
$password = "Esognare2020.";
$dbname = "yuliana";    

//Creo la conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    if (empty($email) || empty($contraseña)) {
        die("Por favor, completa todos los campos.");
    }



//Ya lo que se hace es buscar el usuario en la base de datos

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
} 

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result-> num_rows ===1){
    $usuario = $result->fetch_assoc();

    // Verificar la contraseña

    if (password_verify($contraseña, $usuario['contraseña'])){
        //Iniciamos la sesión
        echo"<script>
        alert('Bienvenid@, $usuario[nombre]');
        window.location.href='../plataforma/inicio.html'; </script>";
        exit;
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script>
        Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: 'Credenciales incorrectas',
        showConfirmButton: false,
        timer: 3000
        });
        </script>";
    }
} else {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
        Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: 'Credenciales incorrectas',
        showConfirmButton: false,
        timer: 3000
        });
        </script>";
    }
}
?>
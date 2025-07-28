
<?php
// Lo que hago es crear una conexión a la base de datos

$conexion = new mysqli("localhost", "root", "Esognare2020.", "yuliana");

if( $conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verifico si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    
    //Verifico que el correo elegido exista en la base de datos
    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
    $consulta->bind_param("s", $email);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado-> num_rows > 0){

        // Este lo que hara es generar un código que llegue al correo para poder recuperar la contraseña.
        $codigo = rand(100000, 999999); // Genera un código aleatorio de 6 dígitos  

        // Aca creo una base de datos para guardar el código
        $guardar= $conexion->prepare("INSERT INTO recuperacion(email, codigo) VALUES (?, ?)");
        $guardar->bind_param("ss", $email, $codigo);
        $guardar->execute();

        // Aca lo que hago es enviar el código al correo
        echo "<script>
            alert('Se ha enviado un código de recuperación a tu correo: $email. Código: $codigo');
            window.location.href = '../inicio/inicio.html'; </script>";

            } else {
                // El correo no se encuentra previamente registrado
                echo "<script> alert('El correo no se encuentra registrado'); window.location.href = '../inicio/inicio.html'; </
script>";
    }

    $consulta->close();
$conexion->close();
}
?>








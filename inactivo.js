const tiempoInactivo = 5*60*1000; // 5 minutos en milisegundos

let temporizadorInactivo;

function reiniciarTemporizador() {
    clearTimeout(temporizadorInactivo);
    temporizadorInactivo = setTimeout(cerrarSesion, tiempoInactivo);

}

function cerrarSesion(){

    alert("Tu sesión ha expirado por inactividad. Por favor, inicia sesión nuevamente.");
    window.location.href = "../inicio/inicio.html"; // Redirige a la página de inicio de sesión
}

 // Se evidencia que el usuario esta activo

 window.onload = reiniciarTemporizador;
    document.onmousemove = reiniciarTemporizador;
    document.onkeypress = reiniciarTemporizador;


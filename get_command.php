<?php
// Configuración de usuario y contraseña
$usuario_valido = "sxbbv58-rchbytec";
$contrasena_valida = "12345678";

// Recibir parámetros
$usuario = $_GET['usuario'] ?? '';
$contrasena = $_GET['contrasena'] ?? '';

// Validar credenciales
if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
    // Leer y borrar el comando
    $comando = file_get_contents("comando.txt");
    file_put_contents("comando.txt", ""); 
    echo $comando;
} else {
    echo "error_credenciales";
}
?>

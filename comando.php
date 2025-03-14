<?php
// ✅ Configuración (sin SSL)
header("Access-Control-Allow-Origin: *"); // Permitir CORS
header("Content-Type: text/plain; charset=utf-8");

$usuario_valido = "sxbbv58-rchbytec";
$contrasena_valida = "12345678";
$deviceSerial_valido = "sxbbv58-rchbytec-srl-V1.28";
$archivo_comandos = __DIR__ . "/comando.txt"; // Ruta absoluta

// Validar parámetros GET
if (!isset($_GET['usuario'], $_GET['contrasena'], $_GET['deviceSerial'], $_GET['comando'])) {
    die("ERROR_FALTAN_PARAMETROS");
}

// Sanitizar entradas
$usuario = filter_var($_GET['usuario'], FILTER_SANITIZE_STRING);
$contrasena = filter_var($_GET['contrasena'], FILTER_SANITIZE_STRING);
$deviceSerial = filter_var($_GET['deviceSerial'], FILTER_SANITIZE_STRING);
$comando = strtolower(filter_var($_GET['comando'], FILTER_SANITIZE_STRING));

// Validar credenciales
if ($usuario !== $usuario_valido || $contrasena !== $contrasena_valida || $deviceSerial !== $deviceSerial_valido) {
    die("ERROR DE CREDENCIALES");
}

// Validar comando permitido
$comandos_permitidos = ['abrir', 'cerrar', 'activar', 'desactivar'];
if (!in_array($comando, $comandos_permitidos)) {
    die("ERROR!!! COMANDO INVALIDO");
}

// Guardar en archivo
if (file_put_contents($archivo_comandos, $comando) === false) {
    die("ERROR DE ESCRITURA EN ARCHIVO");
}

echo "OK COMANDO GUARDADO: $comando";
?>

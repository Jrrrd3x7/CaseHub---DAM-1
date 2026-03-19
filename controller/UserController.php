<?php
// Datos de conexión
$host = "localhost";
$usuario = "root";
$password = "";
$base_datos = "mi_base_datos";

// Crear conexión
$conexion = new mysqli($host, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa";

// Establecer charset UTF-8
$conexion->set_charset("utf8mb4");

// Cerrar conexión
$conexion->close();
?>
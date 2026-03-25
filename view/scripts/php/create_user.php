<?php
$conexion = new mysqli("localhost", "root", "1234567890", "CaseHub");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$country = $_POST['pais'];
$password = $_POST['password'];


$conexion->query("CALL CreateUser('$name', '$surname', '$email', '$country', '$password')");

while ($conexion->more_results() && $conexion->next_result()) {}

$resultado = $conexion->query("CALL PrintUsers()");

echo "<h2>Usuarios registrados</h2>";

while ($u = $resultado->fetch_assoc()) {
    echo $u["ID"] . " - " . $u["Name"] . " - " . $u["Surname"] . " - " . $u["Email"] . "<br>";
}

$conexion->close();
?>
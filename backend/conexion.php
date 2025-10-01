<?php
$host = "localhost";
$user = "tu_usuario";
$password = "tu_contraseña";
$db = "nombre_base_datos";
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

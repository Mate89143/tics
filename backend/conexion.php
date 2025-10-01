<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "tienda";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Error en la conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>

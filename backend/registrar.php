<?php
include 'conexion.php'; // conexión a MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST['nombre'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Encriptar la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar usuario
    $sql = "INSERT INTO usuarios (nombre, email, password) 
            VALUES ('$nombre', '$email', '$password_hash')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Registro exitoso. <a href='../login.html'>Inicia sesión aquí</a>";
    } else {
        if ($conn->errno == 1062) { // 1062 = clave duplicada (correo ya registrado)
            echo "⚠️ El correo ya está registrado.";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
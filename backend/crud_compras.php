<?php
include 'conexion.php'; // Llama a tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    // Validación simple
    if (!empty($id_usuario) && !empty($id_producto) && !empty($cantidad)) {
        $sql = "INSERT INTO compras (id_usuario, id_producto, cantidad) 
                VALUES ('$id_usuario', '$id_producto', '$cantidad')";
        
        if ($conn->query($sql) === TRUE) {
            echo "✅ Compra registrada con éxito";
        } else {
            echo "❌ Error: " . $conn->error;
        }
    } else {
        echo "⚠️ Todos los campos son obligatorios.";
    }
}

$conn->close();
?>

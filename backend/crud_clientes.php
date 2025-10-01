<?php
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM clientes";
    $result = $conn->query($sql);
    $clientes = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($clientes);
}
?>

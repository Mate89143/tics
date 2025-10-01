<?php
include 'conexion.php';

// ---- API para productos (JSON) ----
if (isset($_GET['api'])) {
    header("Content-Type: application/json");
    $result = $conn->query("SELECT * FROM productos");
    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
    echo json_encode($productos, JSON_UNESCAPED_UNICODE);
    exit;
}

// ---- CREATE ----
if (isset($_POST['crear'])) {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];

    $conn->query("INSERT INTO productos (nombre, categoria, precio, stock, descripcion)
                  VALUES ('$nombre','$categoria','$precio','$stock','$descripcion')");
    header("Location: crud_products.php");
    exit;
}

// ---- DELETE ----
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conn->query("DELETE FROM productos WHERE id=$id");
    header("Location: crud_products.php");
    exit;
}

// ---- UPDATE ----
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];

    $conn->query("UPDATE productos 
                  SET nombre='$nombre', categoria='$categoria', precio='$precio', stock='$stock', descripcion='$descripcion'
                  WHERE id=$id");
    header("Location: crud_products.php");
    exit;
}

// ---- READ ----
$result = $conn->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CRUD Productos</title>
  <link rel="stylesheet" href="../css/productos.css">
</head>
<body>
  <header>
    <h1>🐾 Panel de Productos</h1>
    <p>Administra el inventario de la tienda</p>
  </header>

  <!-- Formulario Crear -->
  <section class="formulario">
    <h2>Agregar Producto</h2>
    <form method="POST" class="form-grid">
      <input type="text" name="nombre" placeholder="Nombre" required>
      <select name="categoria" required>
        <option value="perros">Perros</option>
        <option value="gatos">Gatos</option>
        <option value="aves">Aves</option>
        <option value="hamsters">Hámsters</option>
      </select>
      <input type="number" step="0.01" name="precio" placeholder="Precio" required>
      <input type="number" name="stock" placeholder="Stock" required>
      <textarea name="descripcion" placeholder="Descripción"></textarea>
      <button type="submit" name="crear" class="btn crear">Crear</button>
    </form>
  </section>

  <!-- Tabla Productos -->
  <h2>Lista de Productos</h2>
  <table>
    <tr>
      <th>ID</th><th>Nombre</th><th>Categoría</th><th>Precio</th>
      <th>Stock</th><th>Descripción</th><th>Acciones</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <form method="POST">
        <td><?= $row['id'] ?></td>
        <td><input type="text" name="nombre" value="<?= $row['nombre'] ?>"></td>
        <td>
          <select name="categoria">
            <option value="perros" <?= $row['categoria']=="perros"?"selected":"" ?>>Perros</option>
            <option value="gatos" <?= $row['categoria']=="gatos"?"selected":"" ?>>Gatos</option>
            <option value="aves" <?= $row['categoria']=="aves"?"selected":"" ?>>Aves</option>
            <option value="hamsters" <?= $row['categoria']=="hamsters"?"selected":"" ?>>Hámsters</option>
          </select>
        </td>
        <td><input type="number" step="0.01" name="precio" value="<?= $row['precio'] ?>"></td>
        <td><input type="number" name="stock" value="<?= $row['stock'] ?>"></td>
        <td><textarea name="descripcion"><?= $row['descripcion'] ?></textarea></td>
        <td>
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button type="submit" name="actualizar" class="btn actualizar">Actualizar</button>
          <a href="crud_products.php?eliminar=<?= $row['id'] ?>" class="btn eliminar">Eliminar</a>
        </td>
      </form>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>

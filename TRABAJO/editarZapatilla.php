<?php
session_start();

// http://localhost/proyectos/trabajoEnfoque/TRABAJO/entrarComoAdmin.php

if(!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header("Location: login.php");
    exit;
}

require_once("conexion.php");

$id = $_GET['id'] ?? 0;
if ($id <= 0) {
    die("ID no valido");
}

$resultado = $conn->query("SELECT * FROM zapatillas WHERE id = $id");
if (!$resultado || $resultado->num_rows == 0) {
    die("Zapatilla no encontrada");
}

$z = $resultado->fetch_assoc();

if ($_POST) {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $talla = $_POST['talla'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("UPDATE zapatillas SET Marca=?, Modelo=?, Precio=?, Talla=?, Stock=? WHERE id=?");
    if (!$stmt) {
        die("Error prepare: " . $conn->error);
    }
    
    $stmt->bind_param("ssddii", $marca, $modelo, $precio, $talla, $stock, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: adminZapatillas.php");
    exit;
}

?>

<!-- CODIGO HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar zapatilla</title>
</head>
<body>
    <h1>Editar zapatilla</h1>
    <h2>ID: <?= $id ?></h2>
    <form method="post">
        Marca: <input type="text" name="marca" value="
        <?= htmlspecialchars($z['Marca']) ?>" required><br>

        Modelo: <input type="text" name="modelo" value="
        <?= htmlspecialchars($z['Modelo']) ?>" required><br>

        Precio: <input type="number" step="0.01" name="precio" value="
        <?= $z['Precio'] ?>" required><br>

        Talla: <input type="number" step="0.5" name="talla" value="
        <?= $z['Talla'] ?>" required><br>

        Stock: <input type="number" name="stock" value="
        <?= $z['Stock'] ?>" required><br>

        <input type="submit" value="guardar cambios">
    </form>
    <a href="adminZapatillas.php">Cancelar</a>
</body>
</html>
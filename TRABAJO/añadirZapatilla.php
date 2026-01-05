<?php
session_start();

// http://localhost/proyectos/trabajoEnfoque/TRABAJO/entrarComoAdmin.php

if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    die("Acceso denegado");
}

require_once("conexion.php");

if ($_POST) {
    $marca = $_POST['marca'] ?? '';
    $modelo = $_POST['modelo'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $talla = $_POST['talla'] ?? 0;
    $color = $_POST['color'] ?? '';
    $stock = $_POST['stock'] ?? 0;

    $mysqli = "INSERT INTO zapatillas (Marca, Modelo, Precio, Talla, Color, Stock)
        VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($mysqli);
    if (!$stmt) {
        die("Error prepare: " . $conn->error);
    }

    $stmt->bind_param("ssddsi", $marca, $modelo, $precio, $talla, $color, $stock);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: adminZapatillas.php");
    } else {
        echo "Error al insertar. MySQL dijo: " . $stmt->error;
    }
    exit;
}

?>

<!-- CODIGO HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir zapatilla</title>
</head>
<body>
    <h2>Añadir nueva zapatilla</h2>
    <form method="post">
        Marca: <input type="text" name="marca" required><br>
        Modelo: <input type="text" name="modelo" required><br>
        Precio: <input type="number" step="0.01" name="precio" required><br>
        Talla: <input type="number" step="0.5" name="talla" required><br>
        Color: <input type="text" name="color" required><br>
        Stock: <input type="number" name="stock" required><br>
        <input type="submit" value="Guardar zapatilla">
        <a href="adminZapatillas.php">Cancelar</a>
    </form>
</body>
</html>
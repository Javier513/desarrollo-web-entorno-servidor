<?php
session_start();
require_once("conexion.php"),

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die ("Zapatilla no encontrada");

$stmt = $conn->prepare("SELECT * FROM zapatillas WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$z = $resultado->fetch_assoc();

if (!$z) die ("Zapatilla no encontrada");

?>

<!-- CODIGO HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $z['Marca'] ?> <?= $z['Modelo'] ?></title>
</head>
<body>
    <div class="zapatilla">
        <h1><?= htmlspecialchars($z['Marca']) ?> <?= htmlspecialchars($z['Modelo']) ?></h1>
        <p class="precio"><?= number_format($z['Precio'], 2) ?> €</p>
        <p>Talla: <?= $z['Talla'] ?> | Stock: <?= $z['Stock'] ?></p>

        <a href="añadirCarrito.php?id=<?= $id ?>&return=detalleZapatilla.php?id=<?= $id ?>" class="btn">">Añadir al carrito</a>
        <br>
        <a href="catalogo.php"><- Volver al catalogo</a> |
        <a href="carrito.php">Ver carrito (<?= count($_SESSION['carrito'] ?? []) ?>)</a>
    </div>
</body>
</html>
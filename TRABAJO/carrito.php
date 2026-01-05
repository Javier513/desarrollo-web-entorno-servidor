<?php
session_start();

// http://localhost/proyectos/trabajoEnfoque/TRABAJO/carrito.php

require_once("conexion.php");

$carrito = $_SESSION['carrito'] ?? [];
$zapatillas = [];
$total = 0;

if (!empty($carrito)) {
    $ids = implode(',', array_fill(0, count($carrito), '?'));

    $stmt = $conn->prepare ("SELECT * FROM zapatillas WHERE id IN ($ids)");
    $stmt->bind_param(str_repeat('i', count($carrito)), ...$carrito);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($z = $resultado->fetch_assoc()) {
        $zapatillas[] = $z;
        $total += $z['Precio'];
    }
}

?>

<!-- CODIGO HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compra</title>
</head>
<body>
    <h1>Tu carrito (<?= count($carrito) ?> productos)</h1> <!-- CONTADOR DE PRODUCTOS -->
    
        <a href="catalogo.php"> <- Seguir comprando</a><br>
    

    <?php if (empty($zapatillas)): ?>
        <h2>Tu carrito esta vacío.</h2>
    <?php else: ?>

    <table>
        <tr>
            <th>Zapatillas</th>
            <th>Precio</th>
        </tr>
        
    <?php foreach ($zapatillas as $z): 
        $imagen = $z['Imagen'] ?? 'no-image.jpeg';
        if (!str_ends_with(strtolower($imagen), '.jpeg')) $imagen .= '.jpeg'; 
        // STR CONVIERTE EL VALOR ESPECIFICADO EN UNA CADENA
    ?>
    
    <tr>
        <td><?= htmlspecialchars($z['Marca'] . ' ' . $z['Modelo']) ?></td>      
        <td><?= number_format($z['Precio'], 2) ?> €</td>
    </tr>

    <?php endforeach; ?>
<!--
    <tr>
        <td><strong>TOTAL</strong></td>
        <td><strong><?= number_format($total, 2) ?> €</strong></td>
        
    </tr>
-->
    </table>

    <h2>TOTAL: <?= number_format($total, 2) ?> €</h2>   
        <a href="confirmarCompra.php">Confirmar compra</a>
        
    <?php endif; ?>
</body>
</html>
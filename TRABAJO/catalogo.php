<?php
session_start();

// http://localhost/proyectos/trabajoEnfoque/TRABAJO/catalogo.php

require_once("conexion.php");

?>

<!-- CODIGO HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo de zapatillas</title>
</head>
<body>
    <h1>Catalogo de zapatillas</h1>
    <p>
        <a href="index.html"><- Volver al inicio</a> |
        <a href="carrito.php">Ver carrito (<?= count($_SESSION['carrito'] ?? []) ?>)</a>
    </p>
    <div class="catalogo">
    
    <!-- CODIGO PHP PARA MOSTRAR ZAPATILLAS -->
    
    <?php
    $resultado = $conn->query("SELECT * FROM zapatillas ORDER BY id DESC");
    while ($z = $resultado->fetch_assoc()) {
        $id = $z['id'];
        $marca = $z['Marca'];
        $modelo = $z['Modelo'];
        $precio = number_format($z['Precio'], 2);


        echo "<div class='zapatillas'>
        <h3>$marca $modelo</h3>
        <p class='precio'>$precio €</p>
        <a href='añadirCarrito.php?id=$id' class='btn'>Añadir al carrito</a>
        </div>";
    }
    ?>
    </div>
</body>
</html>
<?php
session_start();

// http://localhost/proyectos/trabajoEnfoque/TRABAJO/confirmarCompra.php

unset($_SESSION['carrito']);

?>

<!-- CODIGO HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra confirmada</title>
</head>
<body>
    <h1>¡¡ COMPRA CONFIRMADA !!</h1>
    <h3>Gracias por tu compra. Te enviaremos un email de confirmacion!!</h3>
    <a href="catalogo.php">Volver al catalogo</a>
</body>
</html>
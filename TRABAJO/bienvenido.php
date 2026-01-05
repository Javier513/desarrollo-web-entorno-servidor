<?php
session_start();

if (!isset ($_SESSION['usuario_id'])) {
    header ("Location: login.php");
    exit;
}

?>

<!-- CODIGO HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="trabajo.css">
</head>
<body>
    <h2>Hola, bienvenido a nuestra tienda y gracias por registrarte</h2>

    <a href="catalogo.php">Ir al catalogo de zapatillas</a><br>
    <a href="logout.php">Cerrar sesion</a>
</body>
</html>
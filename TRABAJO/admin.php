<?php
session_start();

if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) { // ISSET COMPRUEBA SI LA VARIABLE EXISTE
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
    <title>Panel administrador</title>
</head>
<body>
    <h1>Panel de Administracion</h1>
    <p>
    <a href="adminClientes.php">Gestionar clientes</a> | 
    <a href="adminZapatillas">Gestionar zapatillas </a> | 
    <a href="logout.php">Cerrar sesion</a>
    </p>
</body>
</html>
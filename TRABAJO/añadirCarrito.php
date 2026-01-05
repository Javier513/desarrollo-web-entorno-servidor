<?php
session_start();

// http://localhost/proyectos/trabajoEnfoque/TRABAJO/añadirCarrito.php

require_once("conexion.php");

$id = (int)($_GET['id'] ?? 0);
$return = $_GET['return'] ?? 'catalogo.php';

if ($id > 0) {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    $_SESSION['carrito'][] = $id;
}

// NOS MANDA AL CATALOGO
header("Location: $return");
exit;

?>
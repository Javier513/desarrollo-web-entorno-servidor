<?php
session_start();
if ($_SESSION['es_admin'] != 1) exit ("No permitido");

require_once("conexion.php");

$id = $_GET['id'];
$conn -> query ("DELETE FROM clientes_nuevos WHERE ID = $id");

header ("Location: adminPanel.php");

?>
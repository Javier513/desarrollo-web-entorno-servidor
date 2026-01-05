<?php
session_start();
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1)  {
    header("Location:login.php");
    exit;
}

require_once("conexion.php");

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM zapatillas WHERE id =?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header ("Location: adminZapatillas.php");
exit;

?>
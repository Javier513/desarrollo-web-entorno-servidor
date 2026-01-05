<?php
session_start();
// SOLO ADMIN PUEDE USAR ESTO
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header("Location: login.php");
    exit;
}

require_once("conexion.php");

$id = (int)$_GET['id'] ?? 0;
$val = (int)$_GET['val'] ?? 0;

if ($id > 0 && ($val == 0 || $val == 1)) {
    $stmt = $conn->prepare("UPDATE clientes_nuevos SET es_admin = ? WHERE ID = ?");
    $stmt->bind_param("ii" , $val, $id);
    $stmt->execute();
    $stmt->close();
}

// VUELVE AL PANEL
header ("Location: adminPanel.php");
exit;
?>
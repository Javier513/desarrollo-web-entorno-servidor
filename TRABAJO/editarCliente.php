<?php
session_start();

if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header("Location: login.php");
    exit;
}
require_once("conexion.php");

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die ("ID no valido");

$resultado = $conn->query("SELECT * FROM clientes_nuevos WHERE ID = $id");
if ($resultado->num_rows == 0) die ("cliente no encontrado");
$cliente = $resultado->fetch_assoc();

if ($_POST) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $dni = $_POST['dni'];

    $stmt = $conn->prepare("UPDATE clientes_nuevos SET Nombre=?, Apellidos=?, Email=?, DNI=? WHERE ID=?");
    $stmt->bind_param("ssssi", $nombre, $apellidos, $email, $dni, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: adminPanel.php");
    exit;
}
?>

<!-- CODIGO HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente</title>
</head>
<body>
    <h2>Editar cliente ID: <?= $id ?></h2>
    <form method="post">
        Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['Nombre']) ?>" required><br>
        Apellidos: <input type="text" name="apellidos" value="<?= htmlspecialchars($cliente['Apellidos']) ?>" required><br>
        Email: <input type="email" name="email" value="<?= htmlspecialchars($cliente['Email']) ?>" required><br>
        DNI: <input type="text" name="dni" value="<?= htmlspecialchars($cliente['DNI']) ?>" required><br>
        <input type="submit" value="Guardar cambios">
    </form>
    <p>
        <a href="adminPanel.php"><- Cancelar</a>
    </p>
</body>
</html>
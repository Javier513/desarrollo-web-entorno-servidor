<?php
session_start();

if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header("Location: login.php");
    exit;
}
require_once("conexion.php");
?>

<!-- CODIGO HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GestiOn de Clientes - Admin</title>
</head>
<body>
    <h1>Gestion de Clientes</h1>
    <p>
        <a href="adminPanel.php"><- Volver al panel</a> | 
        <a href="logout.php">Cerrar sesion</a>
    </p>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Admin</th>
            <th>Acciones</th>
        </tr>

        <?php
        $resultado = $conn->query("SELECT ID, Nombre, Apellidos, Email, DNI, es_admin FROM clientes_nuevos ORDER BY ID DESC");
        while ($row = $resultado->fetch_assoc()) {
            $admin_text = $row['es_admin'] ? "SÍ" : "NO";
            $admin_btn = $row['es_admin'] ? 
                "<a href='toggleAdmin.php?id={$row['ID']}&val=0' class='btn admin'>Quitar Admin</a>" : 
                "<a href='toggleAdmin.php?id={$row['ID']}&val=1' class='btn admin'>Hacer Admin</a>";

            echo "<tr>
                <td>{$row['ID']}</td>
                <td>{$row['Nombre']} {$row['Apellidos']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['DNI']}</td>
                <td>$admin_text</td>
                <td>
                    <a href='editarCliente.php?id={$row['ID']}' class='btn edit'>Editar</a>
                    <a href='eliminarCliente.php?id={$row['ID']}' class='btn delete' onclick='return confirm(\"¿Seguro?\")'>Eliminar</a>
                    $admin_btn
                </td>
            </tr>";
        }
        ?>
        
    </table>
</body>
</html>
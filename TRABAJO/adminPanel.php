<?php

// http://localhost/proyectos/trabajoEnfoque/TRABAJO/adminPanel.php

/* PARA QUE NO ABRA LA VENTANA EN BLANCO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
session_start();

// COMPROBAMOS QUE ES ADMIN
if (!isset ($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header ("Location: login.php");
    exit;
} 

require_once("conexion.php");

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
    <h1>Panel de Administracion - Gestion de clientes</h1>

    <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Admin') ?></strong> 
        | <a href="logout.php">Cerrar sesión</a>  
        | <a href="adminZapatillas.php">Gestionar Zapatillas</a>
        | <a href="adminClientes.php">Gestionar Clientes</a>
    </p>    

    <h2>Lista de clientes</h2>
    <table>
        <tr> 
           <th>ID     |</th>
           <th>Nombre |</th>
           <th>Email  |</th>
           <th>DNI    |</th>
           <th>Admin  |</th>
           <th>Acciones</th>
        </tr>

        <!-- CODIGO PHP -->

        <?php

        $resultado = $conn->query("SELECT ID, Nombre, Apellidos, Email, DNI, es_admin FROM clientes_nuevos
        ORDER BY ID DESC");

        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $admin_text = $row['es_admin'] ? "SI" : "NO";
                $admin_btn = $row['es_admin'] 
                    ? "<a href='toggleAdmin.php?id={$row['ID']}&val=0' class='btn admin'>Quitar Admin</a>" 
                    : "<a href='toggleAdmin.php?id={$row['ID']}&val=1' class='btn admin'>Hacer Admin</a>";

                echo "<tr>
                    <td>{$row['ID']}</td>
                    <td>{$row['Nombre']} {$row['Apellidos']}</td>
                    <td>{$row['Email']}</td>
                    <td>{$row['DNI']}</td>
                    <td>$admin_text</td>
                    <td>
                        <a href='editarCliente.php?id={$row['ID']}' class='btn edit'>Editar</a>
                        <a href='eliminarCliente.php?id={$row['ID']}' class='btn delete' 
                           onclick='return confirm(\"¿Seguro que quieres eliminar?\")'>Eliminar</a>
                        $admin_btn
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay clientes registrados todavia.</td></tr>";
        }
        ?>

    </table>
</body>
</html>
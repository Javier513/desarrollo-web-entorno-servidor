<?php
session_start();

// http://localhost/proyectos/trabajoEnfoque/TRABAJO/entrarComoAdmin.php

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Zapatillas - Admin</title>
</head>
<body>
    <h1>Gestion de Zapatillas</h1>
    <p>
    <a href="adminPanel.php"> <- Volver al panel</a> |
    <a href="logout.php">Cerrar sesion</a> |
    </p>
    <a href="añadirZapatilla.php" class="btn add"> + Añadir Zapatilla</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Precio</th>
            <th>Talla</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>

    <!-- CODIGO PHP -->

    <?php

    $resultado = $conn->query("SELECT * FROM zapatillas ORDER BY id ASC");
    if ($resultado && $resultado->num_rows > 0) {
        while ($z = $resultado->fetch_assoc()) {
/*      $id     = $z['id'] ?? '';
        $marca  = $z['Marca'];
        $modelo = $z['Modelo'];
        $precio = $z['Precio'];
        $talla  = $z['Talla'];
        $stock  = $z['Stock'];
    
    // AÑADIMOS LA IMAGEN
    $imagen = trim($z['Imagen'] ?? '');
    // SI ESTA VACIA O ES 'IMAGEN'
    if (empty($imagen) || $imagen === 'Imagen') {
        $imagen = 'no-image.jpeg';
    }

    // FORZAMOS LA EXTENSION JPEG
    $imagen = $imagen;
    if (!preg_match('/\.(jpe?g|png|gif|webp)$/i', $imagen)) {
    $imagen = '.jpeg';
    }
*/
    echo "<tr>
            <td>{$z['id']}</td>
            <td>" . htmlspecialchars($z['Marca']) . "</td>
            <td>" . htmlspecialchars($z['Modelo']) . "</td>
            <td>" . number_format($z['Precio'], 2) . " €</td>
            <td>{$z['Talla']}</td>
            <td>{$z['Stock']}</td>
            <td>
                <a href='editarZapatilla.php?id={$z['id']}' class='btn edit'>Editar</a>
                <a href='eliminarZapatilla.php?id={$z['id']}' class='btn delete' onclick='return confirm(\"¿Estas seguro que quieres borrarla?\")'>Eliminar</a>
            </td>
        </tr>";
        }
    } 

    ?>

    </table>

</body>
</html>


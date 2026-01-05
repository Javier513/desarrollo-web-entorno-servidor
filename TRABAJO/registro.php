<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Nuevo cliente</title>
    <link rel="stylesheet" href="trabajo.css">
</head>
<body>
    <div class="formulario">
        <h2>Crear cuenta nueva</h2>

    <!-- CODIGO PHP -->

    <?php    
    /*
    if (isset ($_GET['exito']));
    echo "Registro completado!!";
    */
    ?>

    <form action="guardarCliente.php" method="POST">
        <input type="text" name="dni" placeholder="dni" required>
        <input type="text" name="nombre" placeholder="nombre" required>
        <input type="text" name="apellidos" placeholder="apellidos" required>
        <input type="text" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="text" name="Ciudad" placeholder="Ciudad">

        <button type="submit">Registrarme</button>
    </form>

    <p>
        <a href="index.html"><- Volver al inicio</a>
    </p>

    </div>

</body>
</html>



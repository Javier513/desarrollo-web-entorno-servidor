<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clientes</title>
    <link rel="stylesheet" href="trabajo.css">
</head>
<body>
   <div class="formulario">
        <h2>Iniciar sesion</h2>

    <!-- CODIGO PHP -->

    <?php
    if (isset ($_GET['error'])) { // ISSET COMPRUEBA SI LA VARIABLE EXISTE
        echo "<p>Email o contraseña incorrectos</p>";
    }
        
    ?>

    <form action="verificarLogin.php" method="POST">
    
        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Contraseña" required>

        <button type="submit">Entrar</button>
    </form>

    <p>¿Eres nuevo?<a href="nuevosClientes.html">Registrate aqui</a></p>
    <p><a href="index.html"><- Volver al inicio</a></p>

   </div> 
</body>
</html>
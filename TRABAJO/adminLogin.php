<!-- http://localhost/proyectos/trabajoEnfoque/TRABAJO/adminLogin.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login admin</title>
</head>
<body>
    <h2>Acceso administrador</h2>
    <form action="verificarAdmin.php" method="POST">
        Email: <input type="email" name="email" value="admin@zapatillas.com"><br>
        Contraseña: <input type="password" name="password"><br>
        <input type="submit" value="Entrar como Admin">
    </form>
</body>
</html>


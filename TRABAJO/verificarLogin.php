<?php
session_start();
require_once("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);  // TRIM ELIMINA ESPACIOS EN BLANCO
    $password = $_POST['password'];

    // BUSCAMOS POR EMAIL
    $mysqli = "SELECT ID, Nombre, password, es_admin FROM clientes_nuevos WHERE Email = ?";

    $stmt = $conn->prepare($mysqli);  // PREPARA LA CONSULTA PARA SU EJECICION
      if ($stmt === false) {
        die ("Error prepare: " . $conn -> error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // VERIFICAMOS LA CONTRASEÑA
        if (password_verify($password, $usuario['password'])) {

            // SE GUARDA TODO EN SESION
            $_SESSION['usuario_id'] = $usuario['ID'];
            $_SESSION['usuario_nombre'] = $usuario['Nombre'];
            $_SESSION['es_admin'] = (int)$usuario['es_admin'];

            // REDIRECCION SEGUN SI ES ADMIN O NO
            if ($usuario['es_admin'] == 1) {
                header("Location: adminPanel.php");
            } else {
                header("Location: bienvenido.php");
            }
            exit;
        }
    }
    
}
    // SI LLEGA AQUI EL EMAIL O CONTRASEÑA SON INCORRECTOS
    header("Location: login.php?error=1");
    exit;

?>
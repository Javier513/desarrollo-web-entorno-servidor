<?php
session_start();
require_once("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = "admin@zapatillas.com";
$password = $_POST['password'] ?? '';
    if ($email === '' || $password === '') {
        die ("Faltan datos");
    }
}

$mysqli = "SELECT ID, Nombre, es_admin, password FROM clientes_nuevos WHERE Email = ?";

$stmt = $conn->prepare($mysqli);
if ($stmt === false) die ("Error prepare: " . $conn ->error);

$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    if (password_verify($password, $usuario['password']) && $usuario['es_admin'] == 1) {
        $_SESSION['usuario_id'] = $usuario['ID'];
        $_SESSION['usuario_nombre'] = $usuario['Nombre'];
        $_SESSION['es_admin'] = 1;

        header ("Location: adminPanel.php");
        exit;
    }
}

echo "<h3>Acceso denegado o credenciales incorrectas</h3>";
echo "<a href='login.php'>Volver al login</a>"

?>
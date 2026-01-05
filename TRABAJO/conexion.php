<?php
$HOST = 'localhost';
$USUARIO = 'root';          // CAMBIA SI USAS OTRO USUARIO
$PASSWORD = '';
$BASE_DATOS = 'clientes';   // NOMBRE DE LA BASE DE DATOS

$conn = new mysqli($HOST, $USUARIO, $PASSWORD, $BASE_DATOS);

if ($conn -> connect_error) {
    die ("conexion fallida: " . $conn -> connect_error);
}

$conn -> set_charset("utf8mb4");

?>
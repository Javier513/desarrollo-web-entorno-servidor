<?php
session_start();
$_SESSION['es_admin'] = 1;
$_SESSION['usuario_nombre'] = "Admin";
header("Location. adminPanel.php");
exit; 

?>
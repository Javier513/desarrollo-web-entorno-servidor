<?php
session_start();

// URL PARA ENTRAR COMO ADMINISTRADOR
// http://localhost/proyectos/trabajoEnfoque/TRABAJO/entrarComoAdmin.php

$_SESSION['usuario_id']     = 1;
$_SESSION['usuario_nombre'] = "Admin";
$_SESSION['es_admin']       = 1;   // ← Forzamos a 1
header("Location: adminPanel.php");
exit;
?>
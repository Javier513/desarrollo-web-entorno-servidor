<?php

session_start();

echo count($_SESSION['carrito'] ?? []);

?>
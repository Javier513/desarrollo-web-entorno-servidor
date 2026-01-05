<?php

	// http://localhost/proyectos/trabajoEnfoque/TRABAJO/guardarCliente.php

    // conexion.php 
    require_once("conexion.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre      = trim($_POST['nombre'] ?? ''); // TRIM ELIMINA ESPACIOS EN BLANCO
    $apellidos   = trim($_POST['apellidos'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $dni         = strtoupper(trim ($_POST['dni']));
    $ciudad      = trim($_POST['ciudad'] ?? '');
    $cp          = trim($_POST['cp'] ?? '');
    $password    = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // GUARDAMOS EN CLIENTES_NUEVOS
    $mysqli = "INSERT INTO clientes_nuevos 
        (Nombre, Apellidos, Email, password, DNI, Ciudad, CP) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($mysqli);
    $stmt->bind_param("ssssssi", $nombre, $apellidos, $email, $password, $dni, $ciudad, $cp);
    $stmt->execute();
    $stmt->close();

    echo "<p>Bienvenido/a <strong>$nombre $apellidos</strong></p>";
    echo "<h2>¡Registrado con éxito!</h2>";
    echo "<p><a href='login.php'>Ir al login</a></p>";
        }
        $conn -> close();
    
    ?>  







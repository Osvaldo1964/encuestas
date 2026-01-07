<?php
// Configuración de Base de Datos
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db-encuestas";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
    exit();
}

// Alter Table
$sql = "ALTER TABLE especiales MODIFY zona_especial VARCHAR(10) NOT NULL";

if ($mysqli->query($sql) === TRUE) {
    echo "Columna zona_especial modificada a VARCHAR correctamente.\n";
} else {
    echo "Error modificando columna: " . $mysqli->error . "\n";
}

$mysqli->close();

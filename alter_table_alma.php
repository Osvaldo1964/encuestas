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

// Alter Table alma_especial
$sql = "ALTER TABLE especiales MODIFY alma_especial VARCHAR(5) NOT NULL";

if ($mysqli->query($sql) === TRUE) {
    echo "Columna alma_especial modificada a VARCHAR(5) correctamente.\n";
} else {
    echo "Error modificando columna: " . $mysqli->error . "\n";
}

$mysqli->close();

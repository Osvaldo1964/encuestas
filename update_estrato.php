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

// Update Query
// Reemplaza 'RESID--' por 'RES-' en la columna estr_especial
$sql = "UPDATE especiales SET estr_especial = REPLACE(estr_especial, 'RESID--', 'RES-')";

if ($mysqli->query($sql) === TRUE) {
    echo "Registros actualizados exitosamente: " . $mysqli->affected_rows . "\n";
} else {
    echo "Error actualizando registros: " . $mysqli->error . "\n";
}

$mysqli->close();

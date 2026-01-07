<?php

// Configuración de Base de Datos
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db-encuestas";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

$mysqli->set_charset("utf8");

// Archivo CSV
$csvFile = 'datos_especiales.csv';

if (!file_exists($csvFile)) {
    die("El archivo $csvFile no existe.");
}

$fp = fopen($csvFile, 'r');

// Descartar encabezado
fgetcsv($fp, 1000, ";");

$count = 0;
$success = 0;
$errors = 0;

echo "Iniciando importación...\n";

while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
    // Mapeo de columnas según el orden del CSV
    // CSV: sec;matricula;suscriptor;medidor;barrio;direccion;Latitude;Longitude;clas_nombre;tele;email;habi;frec;defr;alma;tial;deal;larg;anch;alto;punt;vivi;devi;tama;cuar;bani;zona;fren;fond;usos;inst;estado

    // Validar integridad básica 
    if (count($data) < 32) {
        $errors++;
        continue; // Faltan columnas
    }

    $matr = $mysqli->real_escape_string($data[1]);
    $susc = $mysqli->real_escape_string($data[2]);
    $medi = $mysqli->real_escape_string($data[3]);
    $barr = $mysqli->real_escape_string($data[4]);
    $dire = $mysqli->real_escape_string($data[5]);
    $lati = $mysqli->real_escape_string($data[6]);
    $long = $mysqli->real_escape_string($data[7]);
    $estr = $mysqli->real_escape_string($data[8]);
    $tele = $mysqli->real_escape_string($data[9]);
    $email = $mysqli->real_escape_string($data[10]);
    $habi = (int)$data[11];
    $frec = $mysqli->real_escape_string($data[12]);
    $defr = $mysqli->real_escape_string($data[13]);
    $alma = $mysqli->real_escape_string($data[14]);
    $tial = $mysqli->real_escape_string($data[15]);
    $deal = $mysqli->real_escape_string($data[16]);
    $larg = (int)$data[17];
    $anch = (int)$data[18];
    $alto = (int)$data[19];
    $punt = (int)$data[20];
    $vivi = $mysqli->real_escape_string($data[21]);
    $devi = $mysqli->real_escape_string($data[22]);
    $tama = (int)$data[23];
    $cuar = (int)$data[24]; // Assuming these are integers
    $bani = (int)$data[25];
    $zona = $mysqli->real_escape_string($data[26]);
    $fren = (int)$data[27];
    $fond = (int)$data[28];
    $usos = $mysqli->real_escape_string($data[29]);
    $inst = $mysqli->real_escape_string($data[30]);
    $estado = (int)$data[31];

    $sql = "INSERT INTO especiales (
        matr_especial, susc_especial, medi_especial, barr_especial, dire_especial, 
        lati_especial, long_especial, estr_especial, tele_especial, email_especial, 
        habi_especial, frec_especial, defr_especial, alma_especial, tial_especial, 
        deal_especial, larg_especial, anch_especial, alto_especial, punt_especial, 
        vivi_especial, devi_especial, tama_especial, cuar_especial, bani_especial, 
        zona_especial, fren_especial, fond_especial, usos_especial, inst_especial, 
        estado_especial
    ) VALUES (
        '$matr', '$susc', '$medi', '$barr', '$dire', 
        '$lati', '$long', '$estr', '$tele', '$email',
        $habi, '$frec', '$defr', '$alma', '$tial',
        '$deal', $larg, $anch, $alto, $punt,
        '$vivi', '$devi', $tama, $cuar, $bani,
        '$zona', $fren, $fond, '$usos', '$inst',
        $estado
    )";

    if ($mysqli->query($sql) === TRUE) {
        $success++;
    } else {
        echo "Error en fila $count: " . $mysqli->error . "\n";
        $errors++;
    }
    $count++;
}

fclose($fp);
$mysqli->close();

echo "Importación finalizada. \n";
echo "Exitosos: $success \n";
echo "Errores: $errors \n";

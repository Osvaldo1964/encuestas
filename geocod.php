<?php
// 1. Configuración de conexión
$host = 'localhost';
$db = 'db-encuestas';
$user = 'root'; // Ajusta según tu configuración
$pass = '';     // Ajusta según tu configuración
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// 2. Tu API Key de Google Maps
$apiKey = 'AIzaSyDDTJ5uq4WEhP4noQ6DKM7aFVUYwGabdu8';

// 3. Consultar direcciones que aún no tienen latitud
// Procesaremos de a 100 por cada vez que corras el script
$stmt = $pdo->query("SELECT id_especial, dire_especial FROM especiales WHERE lati_especial = '' OR lati_especial IS NULL LIMIT 5");
$registros = $stmt->fetchAll();

if (!$registros) {
    die("¡No hay más direcciones por procesar!");
}

echo "<h2>Procesando lote de " . count($registros) . " registros...</h2>";

foreach ($registros as $row) {
    $id = $row['id_especial'];
    // IMPORTANTE: Concatenamos país para mayor precisión
    $direccion = urlencode($row['dire_especial'] . ", Ciénaga, Magdalena, Colombia");

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$direccion}&key={$apiKey}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if ($data['status'] == 'OK') {
        $lat = $data['results'][0]['geometry']['location']['lat'];
        $lng = $data['results'][0]['geometry']['location']['lng'];

        // 4. Actualizar la tabla
        $update = $pdo->prepare("UPDATE especiales SET lati_especial = ?, long_especial = ? WHERE id_especial = ?");
        $update->execute([$lat, $lng, $id]);

        echo "ID {$id}: <span style='color:green;'>OK</span> ({$lat}, {$lng})<br>";
    } else {
        echo "ID {$id}: <span style='color:red;'>ERROR - " . $data['status'] . "</span><br>";
    }

    // Pausa de 100ms para no saturar
    usleep(100000);
}

echo "<br><b>Lote terminado. Recarga la página para procesar los siguientes 100.</b>";
?>
<?php
// DB Config
$host = "localhost";
$db_name = "db-encuestas";
$username = "root";
$password = "";
$charset = "utf8";

try {
    $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

// 1. Truncate table
echo "Truncating table 'especiales'...\n";
$pdo->exec("TRUNCATE TABLE especiales");
echo "Table truncated.\n";

// 2. Open CSV
$csvFile = 'CARGA.csv';
if (!file_exists($csvFile)) {
    die("Error: File $csvFile not found.\n");
}

$handle = fopen($csvFile, "r");
if ($handle === FALSE) {
    die("Error opening file.\n");
}

// Get Header to map (Optional, but good for verification if we wanted dynamic)
$header = fgetcsv($handle, 1000, ";");
// We assume fixed structure based on inspection:
// sec;matricula;suscriptor;medidor;barrio;direccion;Latitude;Longitude;clas_nombre;tele;email;habi;frec;defr;alma;tial;deal;larg;anch;alto;punt;vivi;devi;tama;cuar;bani;zona;fren;fond;usos;inst;estado

$sql = "INSERT INTO especiales (
    matr_especial, susc_especial, medi_especial, barr_especial, dire_especial, 
    lati_especial, long_especial, estr_especial, tele_especial, email_especial, 
    habi_especial, frec_especial, defr_especial, alma_especial, tial_especial, 
    deal_especial, larg_especial, anch_especial, alto_especial, punt_especial, 
    vivi_especial, devi_especial, tama_especial, cuar_especial, bani_especial, 
    zona_especial, fren_especial, fond_especial, usos_especial, inst_especial, 
    estado_especial
) VALUES (
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?
)";

$stmt = $pdo->prepare($sql);
$count = 0;
// Wrap in transaction for speed
$pdo->beginTransaction();

try {
    while (($data = fgetcsv($handle, 2000, ";")) !== FALSE) {
        // Expected 32 columns in CSV based on visual inspection of header
        // Mapping:
        // index 0: sec (SKIP)
        // index 1: matricula
        // ...

        /* 
        Structure:
        0: sec
        1: matricula -> matr_especial
        2: suscriptor -> susc_especial
        3: medidor -> medi_especial
        4: barrio -> barr_especial
        5: direccion -> dire_especial
        6: Latitude -> lati_especial
        7: Longitude -> long_especial
        8: clas_nombre -> estr_especial
        9: tele -> tele_especial
        10: email -> email_especial
        11: habi -> habi_especial
        12: frec -> frec_especial
        13: defr -> defr_especial
        14: alma -> alma_especial
        15: tial -> tial_especial
        16: deal -> deal_especial
        17: larg -> larg_especial
        18: anch -> anch_especial
        19: alto -> alto_especial
        20: punt -> punt_especial
        21: vivi -> vivi_especial
        22: devi -> devi_especial
        23: tama -> tama_especial
        24: cuar -> cuar_especial
        25: bani -> bani_especial
        26: zona -> zona_especial
        27: fren -> fren_especial
        28: fond -> fond_especial
        29: usos -> usos_especial
        30: inst -> inst_especial
        31: estado -> estado_especial
        */

        // Simple validation or casting if needed
        $rowData = [
            $data[1], // matr
            $data[2], // susc
            $data[3], // medi
            $data[4], // barr
            $data[5], // dire
            $data[6], // lati
            $data[7], // long
            $data[8], // estr
            $data[9], // tele
            $data[10], // email
            $data[11], // habi
            $data[12], // frec
            $data[13], // defr
            $data[14], // alma
            $data[15], // tial
            $data[16], // deal
            $data[17], // larg
            $data[18], // anch
            $data[19], // alto
            $data[20], // punt
            $data[21], // vivi
            $data[22], // devi
            $data[23], // tama
            $data[24], // cuar
            $data[25], // bani
            $data[26], // zona
            $data[27], // fren
            $data[28], // fond
            $data[29], // usos
            $data[30], // inst
            $data[31]  // estado
        ];

        // Ensure we pass nulls for empty strings if the DB expects it? 
        // For now, passing empty strings as is, consistent with CSV.

        $stmt->execute($rowData);
        $count++;

        if ($count % 500 == 0) {
            echo "Imported $count rows...\n";
        }
    }

    $pdo->commit();
    echo "Done! Total imported: $count records.\n";

} catch (Exception $e) {
    $pdo->rollBack();
    echo "Failed: " . $e->getMessage() . "\n";
}

fclose($handle);
?>
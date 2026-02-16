<?php
class Especiales extends Controllers
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        parent::__construct();

        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
            die();
        }
        getPermisos(9); // Assuming generic dashboard permission for now
    }

    public function especiales()
    {
        $data['page_tag'] = "Especiales";
        $data['page_title'] = "GESTIÓN ESPECIALES <small>Sistema</small>";
        $data['page_name'] = "especiales";
        $data['page_functions_js'] = "functions_especiales.js?v=" . time();
        $this->views->getView($this, "especiales", $data);
    }

    public function setEspecialesCSV()
    {
        // Aumentar tiempo de ejecución y memoria para archivos grandes
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        if ($_FILES || $_POST) {
            if (!empty($_FILES['fileCSV']['name'])) {
                $filename = $_FILES['fileCSV']['tmp_name'];
                $fileInfo = pathinfo($_FILES['fileCSV']['name']);

                if (strtolower($fileInfo['extension']) != 'csv') {
                    $arrResponse = array('status' => false, 'msg' => 'Formato de archivo inválido. Se espera un CSV.');
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                    die();
                }


                $handle = fopen($filename, "r");
                if ($handle) {
                    $row = 0;
                    $inserted = 0;
                    $skipped = 0;

                    // Leer la primera línea (encabecados) y descartarla
                    $headers = fgetcsv($handle, 10000, ";");

                    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {
                        $row++;
                        // Validar número de columnas
                        if (count($data) < 30) {
                            $skipped++;
                            continue;
                        }

                        try {
                            // Ignoramos index 0 (id_especial)
                            $matr = $data[1] ?? '';
                            $susc = $data[2] ?? '';
                            $medi = $data[3] ?? '';
                            $barr = $data[4] ?? '';
                            $dire = $data[5] ?? '';
                            $lati = $data[6] ?? '';
                            $long = $data[7] ?? '';
                            $estr = $data[8] ?? '';
                            $tele = $data[9] ?? '';
                            $email = $data[10] ?? '';
                            $habi = intval($data[11] ?? 0);
                            $frec = intval($data[12] ?? 0);
                            $defr = intval($data[13] ?? 0);
                            $alma = $data[14] ?? '';
                            $tial = $data[15] ?? '';
                            $deal = $data[16] ?? '';
                            $larg = $data[17] ?? '';
                            $anch = $data[18] ?? '';
                            $alto = $data[19] ?? '';
                            $punt = intval($data[20] ?? 0);
                            $vivi = $data[21] ?? '';
                            $devi = $data[22] ?? '';
                            $tama = $data[23] ?? '';
                            $cuar = $data[24] ?? '';
                            $bani = $data[25] ?? '';
                            $zona = $data[26] ?? '';
                            $fren = intval($data[27] ?? 0);
                            $fond = intval($data[28] ?? 0);
                            $usos = $data[29] ?? '';
                            $inst = $data[30] ?? '';

                            // NOTA: Como estamos en el controlador de la APP, necesitamos instanciar el modelo si no carga automáticamente o usar la propiedad model existente
                            // En la arquitectura MVC típica de este stack, $this->model debería estar disponible si el controlador carga el modelo correspondiente.
                            // Asumiremos que $this->model funciona igual que en otros métodos.

                            $request = $this->model->insertEspecial(
                                $matr,
                                $susc,
                                $medi,
                                $barr,
                                $dire,
                                $lati,
                                $long,
                                $estr,
                                $tele,
                                $email,
                                $habi,
                                $frec,
                                $defr,
                                $alma,
                                $tial,
                                $deal,
                                $larg,
                                $anch,
                                $alto,
                                $punt,
                                $vivi,
                                $devi,
                                $tama,
                                $cuar,
                                $bani,
                                $zona,
                                $fren,
                                $fond,
                                $usos,
                                $inst
                            );

                            if ($request > 0) {
                                $inserted++;
                            } else {
                                $skipped++;
                            }
                        } catch (Exception $e) {
                            $arrResponse = array('status' => false, 'msg' => 'Error en Fila ' . $row . ': ' . $e->getMessage());
                            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                            die();
                        } catch (Throwable $e) {
                            $arrResponse = array('status' => false, 'msg' => 'Error Fatal en Fila ' . $row . ': ' . $e->getMessage());
                            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                            die();
                        }
                    }
                    fclose($handle);

                    $arrResponse = array('status' => true, 'msg' => "Proceso terminado. Insertados: $inserted. Omitidos (Duplicados/Inválidos): $skipped.");
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No se pudo abrir el archivo.');
                }
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No se ha subido ningún archivo.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}

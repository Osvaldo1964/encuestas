<?php

class Especiales extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEspeciales()
    {
        $arrData = $this->model->selectEspeciales();

        for ($i = 0; $i < count($arrData); $i++) {
            $btnEdit = '';
            $btnDelete = '';

            if ($arrData[$i]['estado_especial'] == 1) {
                $arrData[$i]['estado_especial'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['estado_especial'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $btnEdit = '<button class="btn btn-primary btn-sm btnEditEspecial" onClick="fntEditEspecial(' . $arrData[$i]['id_especial'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
            $btnDelete = '<button class="btn btn-danger btn-sm btnDelEspecial" onClick="fntDelEspecial(' . $arrData[$i]['id_especial'] . ')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';

            $arrData[$i]['options'] = '<div class="text-center">' . $btnEdit . ' ' . $btnDelete . '</div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getEspecial($id)
    {
        $intId = intval(strClean($id));
        if ($intId > 0) {
            $arrData = $this->model->selectEspecial($intId);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setEspecial()
    {
        if ($_POST) {
            if (empty($_POST['txtMatr']) || empty($_POST['txtSusc'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $idEspecial = intval($_POST['idEspecial']);
                $strMatr = strClean($_POST['txtMatr']);
                $strSusc = strClean($_POST['txtSusc']);
                $strMedi = strClean($_POST['txtMedi']);
                $strBarr = strClean($_POST['txtBarr']);
                $strDire = strClean($_POST['txtDire']);
                $strLati = strClean($_POST['txtLati']);
                $strLong = strClean($_POST['txtLong']);
                $strEstr = strClean($_POST['txtEstr']);
                $strTele = strClean($_POST['txtTele']);
                $strEmail = strClean($_POST['txtEmail']);
                $strHabi = strClean($_POST['txtHabi']);
                $strFrec = isset($_POST['txtFrec']) ? strClean($_POST['txtFrec']) : '';
                $strDefr = isset($_POST['txtDefr']) ? strClean($_POST['txtDefr']) : '';
                $strAlma = isset($_POST['txtAlma']) ? strClean($_POST['txtAlma']) : '';
                $strTial = isset($_POST['txtTial']) ? strClean($_POST['txtTial']) : '';
                $strDeal = isset($_POST['txtDeal']) ? strClean($_POST['txtDeal']) : '';

                // Fields modified to support decimals (string format for SQL)
                $strLarg = $_POST['txtLarg'];
                $strAnch = $_POST['txtAnch'];
                $strAlto = $_POST['txtAlto'];
                $strTama = $_POST['txtTama'];

                $intPunt = isset($_POST['txtPunt']) ? intval($_POST['txtPunt']) : 0;
                $strVivi = isset($_POST['txtVivi']) ? strClean($_POST['txtVivi']) : '';
                $strDevi = isset($_POST['txtDevi']) ? strClean($_POST['txtDevi']) : '';

                $strCuar = strClean($_POST['txtCuar']);
                $strBani = strClean($_POST['txtBani']);
                $strZona = isset($_POST['txtZona']) ? strClean($_POST['txtZona']) : '';
                $intFren = isset($_POST['txtFren']) ? intval($_POST['txtFren']) : 0;
                $intFond = isset($_POST['txtFond']) ? intval($_POST['txtFond']) : 0;
                $strUsos = strClean($_POST['txtUsos']);
                $strInst = strClean($_POST['txtInst']);

                $intDig = 1;
                $strEfec = strClean($_POST['txtEfec']);

                if ($idEspecial == 0) {
                    $request_user = $this->model->insertEspecial(
                        $strMatr,
                        $strSusc,
                        $strMedi,
                        $strBarr,
                        $strDire,
                        $strLati,
                        $strLong,
                        $strEstr,
                        $strTele,
                        $strEmail,
                        $strHabi,
                        $strFrec,
                        $strDefr,
                        $strAlma,
                        $strTial,
                        $strDeal,
                        $strLarg,
                        $strAnch,
                        $strAlto,
                        $intPunt,
                        $strVivi,
                        $strDevi,
                        $strTama,
                        $strCuar,
                        $strBani,
                        $strZona,
                        $intFren,
                        $intFond,
                        $strUsos,
                        $strInst,
                        $intDig,
                        $strEfec
                    );
                    $option = 1;
                } else {
                    $request_user = $this->model->updateEspecial(
                        $idEspecial,
                        $strMatr,
                        $strSusc,
                        $strMedi,
                        $strBarr,
                        $strDire,
                        $strLati,
                        $strLong,
                        $strEstr,
                        $strTele,
                        $strEmail,
                        $strHabi,
                        $strFrec,
                        $strDefr,
                        $strAlma,
                        $strTial,
                        $strDeal,
                        $strLarg,
                        $strAnch,
                        $strAlto,
                        $intPunt,
                        $strVivi,
                        $strDevi,
                        $strTama,
                        $strCuar,
                        $strBani,
                        $strZona,
                        $intFren,
                        $intFond,
                        $strUsos,
                        $strInst,
                        $intDig,
                        $strEfec
                    );
                    $option = 2;
                }

                if ($request_user > 0) {
                    if ($option == 1) {
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                    }
                } else if ($request_user == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! La Matrícula ya existe.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delEspecial()
    {
        if ($_POST) {
            $intId = intval($_POST['idEspecial']);
            $requestDelete = $this->model->deleteEspecial($intId);
            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el registro');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el registro.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
    }

    public function setEspecialesCSV()
    {
        if ($_POST) {
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
                        // Validar número de columnas (ajustar según tu CSV y Modelo)
                        // El modelo espera 30 parámetros

                        // Mapeo del CSV al Modelo
                        // Índices basados en el CSV provisto:
                        // 0: id, 1: matr, 2: susc, ... 30: inst, 31: estado

                        // Verificar si existe la fila
                        if (count($data) < 30) {
                            $skipped++;
                            continue;
                        }

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
                        $habi = $data[11] ?? '';
                        $frec = $data[12] ?? '';
                        $defr = $data[13] ?? '';
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

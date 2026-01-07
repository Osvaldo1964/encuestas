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
                $strFrec = strClean($_POST['txtFrec']);
                $strDefr = strClean($_POST['txtDefr']);
                $strAlma = strClean($_POST['txtAlma']);
                $strTial = strClean($_POST['txtTial']);
                $strDeal = strClean($_POST['txtDeal']);
                $intLarg = intval($_POST['txtLarg']);
                $intAnch = intval($_POST['txtAnch']);
                $intAlto = intval($_POST['txtAlto']);
                $intPunt = intval($_POST['txtPunt']);
                $strVivi = strClean($_POST['txtVivi']);
                $strDevi = strClean($_POST['txtDevi']);
                $intTama = intval($_POST['txtTama']);
                $strCuar = strClean($_POST['txtCuar']);
                $strBani = strClean($_POST['txtBani']);
                $strZona = strClean($_POST['txtZona']);
                $intFren = intval($_POST['txtFren']);
                $intFond = intval($_POST['txtFond']);
                $strUsos = strClean($_POST['txtUsos']);
                $strInst = strClean($_POST['txtInst']);

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
                        $intLarg,
                        $intAnch,
                        $intAlto,
                        $intPunt,
                        $strVivi,
                        $strDevi,
                        $intTama,
                        $strCuar,
                        $strBani,
                        $strZona,
                        $intFren,
                        $intFond,
                        $strUsos,
                        $strInst
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
                        $intLarg,
                        $intAnch,
                        $intAlto,
                        $intPunt,
                        $strVivi,
                        $strDevi,
                        $intTama,
                        $strCuar,
                        $strBani,
                        $strZona,
                        $intFren,
                        $intFond,
                        $strUsos,
                        $strInst
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
        die();
    }
}

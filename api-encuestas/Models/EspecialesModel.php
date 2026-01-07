<?php

class EspecialesModel extends Mysql
{
    private $intIdEspecial;
    private $strMatr;
    private $strSusc;
    private $strMedi;
    private $strBarr;
    private $strDire;
    private $strLati;
    private $strLong;
    private $strEstr;
    private $strTele;
    private $strEmail;
    private $strHabi;
    private $strFrec;
    private $strDefr;
    private $strAlma;
    private $strTial;
    private $strDeal;
    private $intLarg;
    private $intAnch;
    private $intAlto;
    private $intPunt;
    private $strVivi;
    private $strDevi;
    private $intTama;
    private $strCuar;
    private $strBani;
    private $strZona;
    private $intFren;
    private $intFond;
    private $strUsos;
    private $strInst;
    private $intEstado;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectEspeciales()
    {
        $sql = "SELECT * FROM especiales WHERE estado_especial != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectEspecial(int $id)
    {
        $this->intIdEspecial = $id;
        $sql = "SELECT * FROM especiales WHERE id_especial = $this->intIdEspecial";
        $request = $this->select($sql, array());
        return $request;
    }

    public function insertEspecial(
        string $matr,
        string $susc,
        string $medi,
        string $barr,
        string $dire,
        string $lati,
        string $long,
        string $estr,
        string $tele,
        string $email,
        string $habi,
        string $frec,
        string $defr,
        string $alma,
        string $tial,
        string $deal,
        int $larg,
        int $anch,
        int $alto,
        int $punt,
        string $vivi,
        string $devi,
        int $tama,
        string $cuar,
        string $bani,
        string $zona,
        int $fren,
        int $fond,
        string $usos,
        string $inst
    ) {
        $this->strMatr = $matr;
        $this->strSusc = $susc;
        $this->strMedi = $medi;
        $this->strBarr = $barr;
        $this->strDire = $dire;
        $this->strLati = $lati;
        $this->strLong = $long;
        $this->strEstr = $estr;
        $this->strTele = $tele;
        $this->strEmail = $email;
        $this->strHabi = $habi;
        $this->strFrec = $frec;
        $this->strDefr = $defr;
        $this->strAlma = $alma;
        $this->strTial = $tial;
        $this->strDeal = $deal;
        $this->intLarg = $larg;
        $this->intAnch = $anch;
        $this->intAlto = $alto;
        $this->intPunt = $punt;
        $this->strVivi = $vivi;
        $this->strDevi = $devi;
        $this->intTama = $tama;
        $this->strCuar = $cuar;
        $this->strBani = $bani;
        $this->strZona = $zona;
        $this->intFren = $fren;
        $this->intFond = $fond;
        $this->strUsos = $usos;
        $this->strInst = $inst;
        $this->intEstado = 1;

        $return = 0;
        // Validamos si ya existe la matrícula si aplica, sino quitamos esta validación
        $sql = "SELECT * FROM especiales WHERE matr_especial = '{$this->strMatr}'";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_insert = "INSERT INTO especiales(
                matr_especial, susc_especial, medi_especial, barr_especial, dire_especial, 
                lati_especial, long_especial, estr_especial, tele_especial, email_especial, 
                habi_especial, frec_especial, defr_especial, alma_especial, tial_especial, 
                deal_especial, larg_especial, anch_especial, alto_especial, punt_especial, 
                vivi_especial, devi_especial, tama_especial, cuar_especial, bani_especial, 
                zona_especial, fren_especial, fond_especial, usos_especial, inst_especial, 
                estado_especial) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $arrData = array(
                $this->strMatr,
                $this->strSusc,
                $this->strMedi,
                $this->strBarr,
                $this->strDire,
                $this->strLati,
                $this->strLong,
                $this->strEstr,
                $this->strTele,
                $this->strEmail,
                $this->strHabi,
                $this->strFrec,
                $this->strDefr,
                $this->strAlma,
                $this->strTial,
                $this->strDeal,
                $this->intLarg,
                $this->intAnch,
                $this->intAlto,
                $this->intPunt,
                $this->strVivi,
                $this->strDevi,
                $this->intTama,
                $this->strCuar,
                $this->strBani,
                $this->strZona,
                $this->intFren,
                $this->intFond,
                $this->strUsos,
                $this->strInst,
                $this->intEstado
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function updateEspecial(
        int $id,
        string $matr,
        string $susc,
        string $medi,
        string $barr,
        string $dire,
        string $lati,
        string $long,
        string $estr,
        string $tele,
        string $email,
        string $habi,
        string $frec,
        string $defr,
        string $alma,
        string $tial,
        string $deal,
        int $larg,
        int $anch,
        int $alto,
        int $punt,
        string $vivi,
        string $devi,
        int $tama,
        string $cuar,
        string $bani,
        string $zona,
        int $fren,
        int $fond,
        string $usos,
        string $inst
    ) {
        $this->intIdEspecial = $id;
        $this->strMatr = $matr;
        $this->strSusc = $susc;
        $this->strMedi = $medi;
        $this->strBarr = $barr;
        $this->strDire = $dire;
        $this->strLati = $lati;
        $this->strLong = $long;
        $this->strEstr = $estr;
        $this->strTele = $tele;
        $this->strEmail = $email;
        $this->strHabi = $habi;
        $this->strFrec = $frec;
        $this->strDefr = $defr;
        $this->strAlma = $alma;
        $this->strTial = $tial;
        $this->strDeal = $deal;
        $this->intLarg = $larg;
        $this->intAnch = $anch;
        $this->intAlto = $alto;
        $this->intPunt = $punt;
        $this->strVivi = $vivi;
        $this->strDevi = $devi;
        $this->intTama = $tama;

        $this->strCuar = $cuar;
        $this->strBani = $bani;
        $this->strZona = $zona;
        $this->intFren = $fren;
        $this->intFond = $fond;
        $this->strUsos = $usos;
        $this->strInst = $inst;

        $sql = "SELECT * FROM especiales WHERE matr_especial = '{$this->strMatr}' AND id_especial != $this->intIdEspecial";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE especiales SET 
                matr_especial=?, susc_especial=?, medi_especial=?, barr_especial=?, dire_especial=?, 
                lati_especial=?, long_especial=?, estr_especial=?, tele_especial=?, email_especial=?, 
                habi_especial=?, frec_especial=?, defr_especial=?, alma_especial=?, tial_especial=?, 
                deal_especial=?, larg_especial=?, anch_especial=?, alto_especial=?, punt_especial=?, 
                vivi_especial=?, devi_especial=?, tama_especial=?, cuar_especial=?, bani_especial=?, 
                zona_especial=?, fren_especial=?, fond_especial=?, usos_especial=?, inst_especial=? 
                WHERE id_especial = $this->intIdEspecial";

            $arrData = array(
                $this->strMatr,
                $this->strSusc,
                $this->strMedi,
                $this->strBarr,
                $this->strDire,
                $this->strLati,
                $this->strLong,
                $this->strEstr,
                $this->strTele,
                $this->strEmail,
                $this->strHabi,
                $this->strFrec,
                $this->strDefr,
                $this->strAlma,
                $this->strTial,
                $this->strDeal,
                $this->intLarg,
                $this->intAnch,
                $this->intAlto,
                $this->intPunt,
                $this->strVivi,
                $this->strDevi,
                $this->intTama,
                $this->intCuar,
                $this->intBani,
                $this->strZona,
                $this->intFren,
                $this->intFond,
                $this->strUsos,
                $this->strInst
            );
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteEspecial(int $id)
    {
        $this->intIdEspecial = $id;
        $sql = "UPDATE especiales SET estado_especial = ? WHERE id_especial = $this->intIdEspecial";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}

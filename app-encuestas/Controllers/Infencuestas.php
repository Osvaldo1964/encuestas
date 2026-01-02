<?php
class Infencuestas extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
            die();
        }
        getPermisos(6); // Using generic ID or Reportes ID if exists. 
    }

    public function infencuestas()
    {
        if (empty($_SESSION['permisosMod']['r_permiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag'] = "Informe de Encuestas";
        $data['page_title'] = "Informe detallado de Encuestas";
        $data['page_name'] = "infencuestas";
        $data['page_functions_js'] = "functions_infencuestas.js";
        $this->views->getView($this, "infencuestas", $data);
    }
}

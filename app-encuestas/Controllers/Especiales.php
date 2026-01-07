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
        $data['page_functions_js'] = "functions_especiales.js";
        $this->views->getView($this, "especiales", $data);
    }
}

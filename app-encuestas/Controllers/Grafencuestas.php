<?php
class Grafencuestas extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
            die();
        }
        // Assuming module ID for Reports/Graphs is roughly same or generic '6'. 
        // If there's a specific MDP constant:
        // getPermisos(MDP_INFORMES);
        // For now, mirroring Infencuestas which used 6:
        getPermisos(6);
    }

    public function grafencuestas()
    {
        if (empty($_SESSION['permisosMod']['r_permiso'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag'] = "Gráficos de Encuestas";
        $data['page_title'] = "Gráficos Estadísticos";
        $data['page_name'] = "grafencuestas";
        $data['page_functions_js'] = "functions_grafencuestas.js";
        $this->views->getView($this, "grafencuestas", $data);
    }
}

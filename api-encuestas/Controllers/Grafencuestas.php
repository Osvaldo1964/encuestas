<?php
class Grafencuestas extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSurveys()
    {
        $arrData = $this->model->selectEncuestas();
        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'No hay encuestas activas.');
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getQuestions($idSurvey)
    {
        if (empty($idSurvey)) {
            $arrResponse = array('status' => false, 'msg' => 'Datos inválidos.');
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        $arrData = $this->model->selectQuestions($idSurvey);
        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'No hay preguntas para esta encuesta.');
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getData($params)
    {
        $arrParams = explode(',', $params);
        $idSurvey = isset($arrParams[0]) ? $arrParams[0] : "";
        $idQuestion = isset($arrParams[1]) ? $arrParams[1] : "";

        if (empty($idSurvey) || empty($idQuestion)) {
            $arrResponse = array('status' => false, 'msg' => 'Datos inválidos.');
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

        $arrData = $this->model->selectRespuestaConteo($idSurvey, $idQuestion);

        // Prepare data specifically for Chart.js
        $labels = [];
        $counts = [];
        $colors = [];

        foreach ($arrData as $row) {
            $labels[] = $row['label'];
            $counts[] = $row['cantidad'];
            // Generate a random color or use a palette generator in JS. 
            // Sending generic data is better, let JS handle colors.
        }

        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'No hay respuestas registradas para esta pregunta.');
        } else {
            $arrResponse = array(
                'status' => true,
                'data' => $arrData,
                'chartData' => [
                    'labels' => $labels,
                    'counts' => $counts
                ]
            );
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
}

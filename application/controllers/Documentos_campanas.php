<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos_campanas extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('DocumentosCampana_model', 'modelDocCamp', true);
    }
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    /**
     * documentow
     * Obtiene todos los documentos
     */
    public function getDocumentosCampanas(){        
        $la_dataView = array();

        if($this->modelDocCamp->getCampanasModel($dataOut, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        $la_dataView['campanias'] = $dataOut;

        if($this->modelDocCamp->getClientesModel($dataClientes, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }

        $la_dataView['clientes'] = $dataClientes;


        $ls_vistaPanelGeneral = $this->load->view('documento_campana/documento_campana_view', $la_dataView, true);

        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Vacantes"
        );        

        $this->layoutPanel($la_dataView);
        
    }

    public function guardarDocumentosCampanas(){
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $la_data = array(
                "cliente"        => $this->input->post('data')['cliente'],
                "campana"       => $this->input->post('data')['campana'],
                "descripcion"   => $this->input->post('data')['descripcion']
            );

            if($this->modelDocCamp->nuevoCampana($la_data, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

        }catch(Exception $e){
            $arg_mensaje = '"guardarDocumentosCampanas" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

}

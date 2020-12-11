<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archivos extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('Archivos_model', 'modelArchivo', true);
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
    public function verArchivos(){        
        $la_dataView = array();

        if($this->modelArchivo->obtnerTipoArchivos($dataOut, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        $la_dataView['tipos'] = $dataOut;

        $ls_vistaPanelGeneral = $this->load->view('archivos/archivos_view', $la_dataView, true);

        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Vacantes"
        );        
        $this->layoutPanel($la_dataView);
        
    }

    public function nuevoTipoArchivo(){

        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $tipo = $this->input->post('tipo');

            if($this->modelArchivo->m_nuevotipoArchivo($tipo,$arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

        }catch(Exception $e){
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }
   
}

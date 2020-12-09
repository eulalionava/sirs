<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('Cuestionarios_model', 'modelCuestionarios', true);
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
    public function documentos(){        
        $la_dataView = array();

        if($this->modelDoc->getDocs($dataOut, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        $la_dataView['documentos'] = $dataOut;

        $ls_vistaPanelGeneral = $this->load->view('documentos/documentos_view', $la_dataView, true);

        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Vacantes"
        );        
        $this->layoutPanel($la_dataView);
        
    }

    /**
     * nuevoDocumento
     * Alta de un nuevo documento
     */
    public function nuevoDocumento(){
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $la_data = array(
                "documento"    => $this->input->post('data')['documento'],
                "descripcion"  => $this->input->post('data')['descripcion']
            );

            if($this->modelDoc->nuevoDocumento($la_data, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

        }catch(Exception $e){
            $arg_mensaje = '"nuevoDocumento" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    /**
     * editarDocumento
     * Edicion de un documento
     */
    public function editarDocumento(){
    
        
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $la_data = array(
                "id_documento" =>$this->input->post('data')['id_documento'],
                "documento"    => $this->input->post('data')['documento'],
                "descripcion"  => $this->input->post('data')['descripcion']
            );

            if($this->modelDoc->editaDocumento($la_data, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

        }catch(Exception $e){
            $arg_mensaje = '"nuevoDocumento" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }
   
}

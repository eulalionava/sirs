<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuestionarios extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('Cuestionarios_model', 'modelCuestionario', true);
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
    public function cuestionarios(){        
        $la_dataView = array();

        if($this->modelCuestionario->getClientes($dataOut, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        $la_dataView['clientes'] = $dataOut;

        if($this->modelCuestionario->getTipoCuestionario($dataOut, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        $la_dataView['tipos'] = $dataOut;

        if($this->modelCuestionario->getCuestionarios($dataOut, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        $la_dataView['cuestionarios'] = $dataOut;
        

        $ls_vistaPanelGeneral = $this->load->view('cuestionarios/cuestionarios_view', $la_dataView, true);

        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Vacantes"
        );        
        $this->layoutPanel($la_dataView);
        
    }

    /**
     * editarCestionario
     * Edicion registro de un cuestionario
     */
    public function editarCestionario(){
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $la_data = array(
                "id_cuestionario"   => $this->input->post('data')['id_cuestionario'],
                "cuestionario"      => $this->input->post('data')['cuestionario'],
                "descripcion"       => $this->input->post('data')['descripcion'],
                "intentos"          => $this->input->post('data')['intentos']
            );

            if($this->modelCuestionario->editaCuestionario($la_data, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

        }catch(Exception $e){
            $arg_mensaje = '"editarCestionario" controller does not work. Exception: ' . $e->getTraceAsString();
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

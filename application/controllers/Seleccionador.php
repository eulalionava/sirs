<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seleccionador extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('Seleccionador_model', 'modelSelecionador', true);
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
    public function index(){        
        $la_dataView = array();
        $ls_vistaPanelGeneral = $this->load->view('reclutamiento/reclutador_view', array(), true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Reclutamiento"
        );        
        $this->layoutPanel($la_dataView);
    }

    public function verMiAgenda(){

        $respuesta = array();
        $respuesta['ok'] = true; 

        $la_dataIn = array(
            "id_persona_entidad"    => $this->id_persona_entidad,
            "fecha_actual"          => date("Y-m-d",strtotime(date("Y-m-d")."- 1 days"))
        );

        if($this->modelSelecionador->getEntrevistas($la_dataIn,$data,$mensage) < 0){
            $respuesta['ok'] = false;
        }

        $respuesta['data'] = $data;
        $respuesta['mensaje'] = $mensage;

        $ls_vistaPanelGeneral = $this->load->view('seleccionamiento/mi_agenda_view', $respuesta, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Mi agenda"
        );        
        $this->layoutPanel($la_dataView);

    }

    public function entrevistaDetalle(){

        try{
            $respuesta = array();
            $respuesta['ok'] = true; 

            $id = $this->input->post('id');

            if($this->modelSelecionador->getEntrevistaDetalle($id,$la_dataIn,$mensage) < 0){
                $respuesta['ok'] = false;
            }
            $respuesta['data']      = $la_dataIn;

            $ls_seleccionadores = $this->load->view('seleccionamiento/detalle_entrevista_view', $respuesta, true);
            $respuesta['contenido'] = $ls_seleccionadores;

        }catch(Exception $e){
            $ls_mensaje = '"entrevistaDetalle" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    public function agregarComentario(){
        try{
            $respuesta = array();
            $respuesta['ok'] = true; 

            $datos = array(
                "id_entrevista"     => $this->input->post('id'),
                "comentario"        => $this->input->post('comentario')
            );

            if($this->modelSelecionador->addEntrevistaComentario($datos) < 0){
                $respuesta['ok'] = false;
            }

        }catch(Exception $e){
            $ls_mensaje = '"agregarComentario" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    
}

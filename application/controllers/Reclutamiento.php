<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reclutamiento extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('Reclutamiento_model', 'modelRecluta', true);
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

    public function agenda(){

        $la_dataView = array();
        $ls_vistaPanelGeneral = $this->load->view('reclutamiento/agendar_horario_view', array(), true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Agendar Horario"
        );        
        $this->layoutPanel($la_dataView);

    }
    /**
     * agendarHorario
     * se agendan los horarios de entrevista
     */
    public function agendarHorario(){

        try{
            $respuesta =array();
            $respuesta['ok'] = true;

            $datos = $this->input->post('data');

            if($this->modelRecluta->guardarHorario($datos,$mensage) < 0){
                $respuesta['mensaje'] = $mensage;
                $respuesta['ok'] = false;
                return;
            }

            $respuesta['mensaje'] = 'Horario agendado correctamente';

        }catch(Exception $e){

            $ls_mensaje = '"agendarHorario" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['ok'] = false;
            return;

        }finally{

            header("Content-type: application/json");
            echo json_encode($respuesta);
        }

        return 1;
    }

    /**
     * verHorarios
     * Muestra todos los horarios que se encuentran disponibles en el dia actual 
     */

    public function verHorarios(){
        $respuesta = array();
        $diaActual = date("Y-m-d");
        $respuesta['ok'] = true;

        if($this->modelRecluta->verHorariosAgendados($diaActual,$data,$mensage) < 0){
            $respuesta['mensaje'] = "No se encontraron registros";
            $respuesta['ok'] = false;
            return;
        }

        $respuesta['data']      = $data;

        $la_dataView = array();
        $ls_vistaPanelGeneral = $this->load->view('reclutamiento/horarios_view', $respuesta, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Horarios"
        );        

        $this->layoutPanel($la_dataView);

    }

    /**
     * Selecionadores
     * Obtiene todos los usuarios que son de tipo seleccionador
     */
    public function seleccionadores(){

        $respuesta = array();
        $respuesta['ok'] = true;

        if($this->modelRecluta->getEntrevistadores($data,$mensage) < 0){
            $respuesta['ok'] = false;
            $respuesta['mensaje'] = "No no se encontraron registros";
        }

        $respuesta['data'] = $data;

        $la_dataView = array();
        $ls_vistaPanelGeneral = $this->load->view('reclutamiento/seleccionadores_view', $respuesta, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Seleccionadores"
        );        
        $this->layoutPanel($la_dataView);

    }

    /**
     * altaEntrevistador
     * Dara de alta los entrevistadores que atenderan en trevistas
     */

    public function altaEntrevistador(){
        try{
            $respuesta = array();
            $respuesta['ok'] = true;
            $datos = $this->input->post('data');

            if($this->modelRecluta->agregarEntre($datos,$mensage) < 0){
                $respuesta['ok'] = false;
            }
            
            $respuesta['mensaje'] = "Entrevistadores, fueron dados de alta correctamente";
            

        }catch(Exception $e){

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }
    /**
     * showEntrevistadores
     * Muestra de seleccionadores que estan dados de alta
     */
    public function showEntrevistadores(){
        try{
            $respuesta = array();
            $respuesta['ok'] = false;

            if($this->modelRecluta->getSeleccionados($datos,$mensage) < 0){
                $respuesta['ok'] = false;
            }

            if( count($datos)  > 0 ){
                $respuesta['ok']    = true;
                $respuesta['data']  = $datos;
            }else{
                $respuesta['ok'] = false;
            }

            $ls_seleccionadores = $this->load->view('reclutamiento/listado_seleccionadores_view', $respuesta, true);
            $respuesta['contenido'] = $ls_seleccionadores;

        }catch(Exception $e){
            $ls_mensaje = '"showEntrevistadores" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }
    /**
     * bajaSeleccionador
     * Baja de seleccionadores
     */
    public function bajaSeleccionador(){
        try{
            $respuesta = array();

            $respuesta['ok'] = true;
            $id = $this->input->post('id');

            if($this->modelRecluta->bajaSeleccinador($id,$mensage) < 0){
                $respuesta['ok']        = false;
                $respuesta['mensaje']   = $mensage;
            }
            
            $respuesta['mensaje'] = "Seleccionador dado de baja correctamente";
            

        }catch(Exception $e){

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    
}

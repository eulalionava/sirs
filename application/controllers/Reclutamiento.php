<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reclutamiento extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('Reclutamiento_model', 'modelRecluta', true);
        $this->load->model('InformacionCandidatos_model', 'mCandidato', true);
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

        $ls_vistaPanelGeneral = $this->load->view('reclutamiento/agendar_horario_view', $respuesta, true);
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
    /**
     * agendarHorarios
     * Agenda todos los horarios por seleccionador
     */
    public function agendarHorarios(){
        try{
            $respuesta = array();

            $respuesta['ok'] = true;
            $datos = $this->input->post('data');

            if($this->modelRecluta->guardarHorario($datos,$mensage) < 0){
                $respuesta['ok']        = false;
                $respuesta['mensaje']   = $mensage;
            }

            $respuesta['id_entrevistador']  = $datos[0]['id_entrevistador'];
            $respuesta['mensaje']           = "Hararios generados correctamente";
            

        }catch(Exception $e){

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }
    /**
     * misCandidatos
     * Obtiene todos los candidatos que visualizara el reclutador
     */
    public function misCandidatos(){
        $la_dataView = array();

        if($this->modelRecluta->getAllCandidatos($dataOut,$mensage) < 0){
            $la_dataView['ok'] = false;
        }
        $la_dataView['data'] = $dataOut;

        $ls_vistaPanelGeneral = $this->load->view('reclutamiento/mis_candidatos_view', $la_dataView, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Mis Candidatos"
        );        
        $this->layoutPanel($la_dataView);
    }
    /**
     * vacantesCandidatos
     * Obtiene todas las vacantes por candidato
     */
    public function vacantesCandidatos(){
        try{
            $respuesta = array();

            $respuesta['ok'] = true;
            $id_persona = $this->input->post('entidad');

            if($this->modelRecluta->vacantesPorCandidato($id_persona,$dataOut,$mensage) < 0){
                $respuesta['ok']        = false;
                $respuesta['mensaje']   = $mensage;
            }
            $respuesta['mensaje']   = $mensage;
            $respuesta['vacantes']  = $dataOut;

            $ls_seleccionadores = $this->load->view('reclutamiento/vacantes_candidatos_view', $respuesta, true);
            $respuesta['contenido'] = $ls_seleccionadores;
            

        }catch(Exception $e){

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }
    /**
     * cuestionariosCandidatos
     * Obtiene la verificacion de todos los cuestionarios que tiene el candidato
     */
    public function cuestionariosCandidatos(){
        try{
            $respuesta = array();

            $respuesta['ok'] = true;

            $la_dataIn = array(
                "id_usuario" => $this->input->post('usuario'),
                "id_vacante" => $this->input->post('vacante')
            );

            if($this->modelRecluta->cuastionariosCandidato($la_dataIn,$dataOut,$mensage) < 0){
                $respuesta['ok']        = false;
                $respuesta['mensaje']   = $mensage;
            }
            $respuesta['cuestionarios'] = $dataOut;

        }catch(Exception $e){

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    /**
     * documentosCandidatos
     * Obtiene la verificacion de todos los ducumentos por candidato
     */
    public function documentosCandidatos(){
        try{
            $respuesta = array();

            $respuesta['ok'] = true;

            $la_dataIn = array(
                "id_vacante" => $this->input->post('vacante')
            );

            if($this->modelRecluta->obtenerDocumentosCandidato($la_dataIn,$dataOut,$mensage) < 0){
                $respuesta['ok']        = false;
                $respuesta['mensaje']   = $mensage;
            }

            $respuesta['documentos']    = $dataOut;

        }catch(Exception $e){

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    public function segimientoVacante(){
        try{
            $respuesta = array();

            $respuesta['ok'] = true;

            $la_dataIn = array(
                "id_persona_vacante" => $this->input->post('persona_vacante')
            );

            if($this->modelRecluta->segimientoModel($la_dataIn,$dataOut,$mensage) < 0){
                $respuesta['ok']        = false;
                $respuesta['mensaje']   = $mensage;
            }

            $respuesta['segimiento']    = $dataOut;

        }catch(Exception $e){

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    public function guardarSegimiento(){
        try{
            $respuesta = array();

            $respuesta['ok'] = true;

            $la_dataIn = array(
                "id_persona"    => $this->input->post('data')['id_persona_entidad'],
                "id_vacante"    => $this->input->post('data')['id_persona_vacante'],
                "id_usuario"    => $this->input->post('data')['id_usuario'],
                "estatus"       => $this->input->post('data')['status'],
            );
    
            if($this->modelRecluta->guardarSegimiento($la_dataIn,$mensage) < 0){
                $respuesta['ok']        = false;
                $respuesta['mensaje']   = $mensage;
            }

        }catch(Exception $e){

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }

    }
    
}

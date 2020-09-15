<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SolicitudEmpleo extends MY_Controller {    
    public function __construct(){
        parent::__construct();
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
        $ls_vistaPanelGeneral = $this->load->view('candidatos/solicitud_empleado_view', array(), true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Solicitud de empleo"
        );        
        $this->layoutPanel($la_dataView);
    }
    public function continuarTramite(){
        $la_dataIn = array(
            "id_persona_entidad" => $this->id_persona_entidad
        );
        
        if($this->mCandidato->obtenerEstructuraCompletaCandidato($la_dataIn, $la_dataCandidato, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        
        $li_total_registros = count($la_dataCandidato);
        $la_cuestionarioGeneral = array();
        $la_cuestionarioOrtografia = array();
        $la_cuestionarioTyping = array();
        $la_documentosSolicitar = array();
        
        $ls_ruta_solicitud_empleo = "";
        if($li_total_registros > 0){
            foreach($la_dataCandidato as $dataCandidato){
                if($dataCandidato->id_tipo_cuestionario == 1){
                    $la_cuestionarioOrtografia[] = $dataCandidato;
                }
                
                if($dataCandidato->id_tipo_cuestionario == 2){
                    $la_cuestionarioTyping[] = $dataCandidato;
                }
                
                if($dataCandidato->id_tipo_cuestionario == 3){
                    $la_cuestionarioGeneral[] = $dataCandidato;
                }
            }
            
            $ls_ruta_solicitud_empleo = $la_dataCandidato[0]->solicitud_cliente; 
            
            $la_dataInDocs = array(
                "id_campania" => $la_dataCandidato[0]->id_campania
            );
            
            if($this->mCandidato->obtenerSolicitarDocumentos($la_dataInDocs, $la_documentosSolicitar, $arg_mensaje) < 0){
                echo $arg_mensaje;
            }
        }
        
        $la_dataView = array(
            "cuestionario_general" => $la_cuestionarioGeneral,
            "cuestionario_ortografia" => $la_cuestionarioOrtografia,
            "cuestionario_typing" => $la_cuestionarioTyping,
            "solicitud_cliente" => $ls_ruta_solicitud_empleo,
            "solicitar_documentos" => $la_documentosSolicitar
        );
        $ls_vistaPanelGeneral = $this->load->view('candidatos/continuar_tramite_candidato_view', $la_dataView, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Solicitud de empleo"
        );        
        $this->layoutPanel($la_dataView);
    }    
}

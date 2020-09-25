<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class misPostulaciones extends MY_Controller {    
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
        $ls_vistaPanelGeneral = $this->load->view('candidatos/postulaciones_candidatos_view', array(), true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Mis postulaciones"
        );        
        $this->layoutPanel($la_dataView);
    }
    
    public function detalleVacante(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
            
            $la_dataIn = array(
                "id_persona_entidad" => $this->id_persona_entidad,
                "id_vacante_md5" => $this->input->post('data')['hash']
            );
            $la_dataOut = array();
            if($this->mCandidato->obtenerVacantesCandidato($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
                $la_return['mensaje'] = $ls_mensaje;
                $la_return['return'] = -1;
                return;
            }

            $la_dataView = array(
                "detalle_vacante" => $la_dataOut
            );

            $ls_detalleVacante = $this->load->view('candidatos/detalle_vacante_view', $la_dataView, true);
            $la_return['contenido'] = $ls_detalleVacante;
        }catch(Exception $exc) {
            $ls_mensaje = '"detalleVacante" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function vacantesCandidato(){
        $la_dataIn = array(
            "id_persona_entidad" => $this->id_persona_entidad
        );
        $la_dataOut = array();
        if($this->mCandidato->obtenerVacantesCandidato($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
            echo $ls_mensaje;
        }
        
        $la_dataView = array(
            "mis_vacantes" => $la_dataOut
        );
        
        $ls_vistaPanelGeneral = $this->load->view('candidatos/mis_vacantes_candidato_view', $la_dataView, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Solicitud de empleo"
        );        
        $this->layoutPanel($la_dataView);
    }    
}

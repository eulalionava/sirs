<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReclutamientoSeleccion extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('ReclutamientoSeleccion_model', 'mRS', true);
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
        $ls_vistaPanelGeneral = $this->load->view('reclutamiento_seleccion/reclutamiento_seleccion_view', array(), true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Micuenta"
        );        
        $this->layoutPanel($la_dataView);
    }
    
    public function generarTokens(){
        $la_dataIn = array(
            "id_persona_entidad" => $this->id_persona_entidad,
            "tipo_persona" => $this->tipo_persona_entidad
        );
        
        $la_dataTokens = array();
        $ls_mensaje = "";
        if($this->mRS->obtenerTokensGenerados($la_dataIn, $la_dataTokens, $ls_mensaje) < 0){
            echo $ls_mensaje;
        }
        
        $la_dataView = array(
            "data_tokens" => $la_dataTokens
        );
        
        $ls_vistaPanelGeneral = $this->load->view('reclutamiento_seleccion/generar_token_view', $la_dataView, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Generar token de candidato"
        );
        
        $this->layoutPanel($la_dataView);
    }    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public $tipo_persona_entidad = 0, $id_usuario = 0, $id_persona_entidad;
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        
        if(!isset($this->session->id_usuario)){
            redirect(base_url(), 'refresh', 401);
        }
        
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            sleep(2);
        }              
        
        
        $this->load->model("PanelPrincipal_model", "mPanel", true);
        $this->tipo_persona_entidad = $this->session->userdata['tipo_persona_entidad'];
        $this->id_usuario = $this->session->userdata['id_usuario'];
        $this->id_persona_entidad = $this->session->userdata['id_persona_entidad'];
        
    }
    
    /**
     * layoutPanel: Método para cargar el layout general del panel.
     * @param String $arg_view nombre de la vista.
     * @param Array $la_params parámetros de la vista.
     */
    public function layoutPanel($la_dataIn) {
        $la_dataInMenu = array(
            "id_usuario" => $this->id_usuario
        );
        if($this->mPanel->obtenerMenuUsuario($la_dataInMenu, $la_dataMenu, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        
        $la_dataLayout = array(
            "content" => $la_dataIn['view'],
            "data_usuario" => $this->session->userdata,
            "title" => $la_dataIn['title'],
            "data_menu" => $la_dataMenu
        );
        
        
        $this->load->view('templates/layout_panel_view', $la_dataLayout, false);
    }
}
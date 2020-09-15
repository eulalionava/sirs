<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends MY_Controller {    
    public function __construct(){
        parent::__construct();        
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
        /*Tipos de vista para el panel principal:
         * 0 = Administrador
         * 1 = Reclutadores
         * 2 = Seleccionadores
         * 3 = Clientes
         * 4 = Welcome
         * 5 = Candidatos
         */        
        $la_tiposVista = array(
            "principal/contenido_administrador_view",
            "principal/contenido_reclutador_view",
            "principal/contenido_seleccionador_view",
            "principal/contenido_cliente_view",
            "principal/contenido_welcome_view",
            "candidatos/panel_candidato_view"
        );       
        
        $la_dataView = array();
        $ls_vistaPanelGeneral = $this->load->view($la_tiposVista[$this->tipo_persona_entidad], $la_dataView, true); 
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Panel principal"
        );        
        $this->layoutPanel($la_dataView);
    }
}

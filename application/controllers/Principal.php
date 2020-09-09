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
        $li_tipo_persona_entidad = $this->session->userdata['tipo_persona_entidad'];
        $la_dataInfoExtra = array();
        if($li_tipo_persona_entidad == 5){
            $this->load->model('informacionCandidtos_model', 'mCandidato', true);
            
            $la_dataIn = array();            
            if($this->mCandidato->obtenerCuestionario($la_dataIn, $la_dataCuestionario, $arg_mensaje) < 0){
                echo $arg_mensaje;
                return -1;
            }
            
            $la_cuestionarioData = array(
                "data" => $la_dataCuestionario
            );
            $ls_cuestionarioPrueba = $this->load->view('candidatos/cuestionario_candidato_view', $la_cuestionarioData, true);
            
            $la_dataInfoExtra["cuestionario"] = $ls_cuestionarioPrueba;
        }
        
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
            "candidatos/contenido_candidato_view"
        );
        
        $la_contenidoVistaParticular = array("extras" => $la_dataInfoExtra);
        $la_contenidoPanelPrincipal = array(
            "contenido" => $this->load->view($la_tiposVista[$li_tipo_persona_entidad], $la_contenidoVistaParticular, true),
            "data_usuario" => $this->session->userdata            
        );
        $ls_vistaPanelGeneral = $this->load->view('principal/panel_principal_view', $la_contenidoPanelPrincipal, true);
        
        $la_dataView = array(
            "title" => "Panel principal",
            "content" => $ls_vistaPanelGeneral
        );
        $this->load->view('templates/header_panel_view', $la_dataView, false);        
        $this->load->view('templates/footer_panel_view');
    }
}

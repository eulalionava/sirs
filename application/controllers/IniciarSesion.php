<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IniciarSesion extends MY_Controller {    
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
        $la_dataView = array(
            "title" => "Iniciar sesión"
        );
        $this->load->view('templates/header_inicio_view', $la_dataView, false);
        $this->load->view('iniciar_sesion/login_view');
        $this->load->view('templates/footer_inicio_view');
    }
    
    public function restaurarPassword(){
        $la_dataView = array(
            "title" => "Recuperar contraseña"
        );
        $this->load->view('templates/header_inicio_view', $la_dataView, false);
        $this->load->view('iniciar_sesion/rstaurar_password_view');
        $this->load->view('templates/footer_inicio_view');
    }
}

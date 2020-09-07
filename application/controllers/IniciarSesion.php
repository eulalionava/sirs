<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IniciarSesion extends MY_Controller {
    private $usuario = "", $password = "";
    public function __construct(){
        parent::__construct();
        $this->load->model('IniciarSesion_model', 'mLogin', TRUE);        
        if(isset($this->input->post('data')['usuario'])){
            $this->usuario = $this->input->post('data')['usuario'];
            $this->password = $this->input->post('data')['password'];            
        }
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
    
    /*
     * Nombre método: procesarSesion
     * Route: iniciar-sesion
     * Descripción: se procesan los datos ingresados por el usuario para iniciar sesión y se inicializa la sesión.
     * Fecha: 2020-09-06
     * Autor: Eulalio Vázquez
     */
    public function procesarSesion(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
                
            $la_dataIn = array(
                "id_usuario" => $this->usuario
            );            
            if($this->mLogin->obtnerInformacionUsuario($la_dataIn, $la_dataOut, $arg_mensaje) < 0){
                $la_return['mensaje'] = $arg_mensaje;
                $la_return['return'] = -1;
                return -1;
            }
            
            var_dump($la_dataOut);
        }catch(Exception $exc) {
            $ls_mensaje = '"procesarSesion" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
}

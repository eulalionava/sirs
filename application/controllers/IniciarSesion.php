<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IniciarSesion extends CI_Controller {
    private $usuario = "", $password = "";
    public function __construct(){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            sleep(2);
        }
        parent::__construct();        
        $this->load->library('session');
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
        if($this->session->has_userdata('id_usuario')){
            redirect(base_url('panel-principal'), 'refresh', 401);
        }
        
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
     * Nombre método: finalizarSesion
     * Route: finalizar-sesion
     * Descripción: la sesión actual, se dará por terminada.
     * Fecha: 2020-09-07
     * Autor: Eulalio Vázquez
     */
    public function finalizarSesion(){
        try{
            $this->session->sess_destroy();                        
        }catch(Exception $exc) {
            $ls_mensaje = '"finalizarSesion" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            redirect(base_url());
        }        
        return 1;
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
            $la_return['login'] = false;
                
            $la_dataIn = array(
                "usuario" => $this->usuario
            );            
            if($this->mLogin->obtnerInformacionUsuario($la_dataIn, $la_dataOut, $arg_mensaje) < 0){
                $la_return['mensaje'] = $arg_mensaje;
                $la_return['return'] = -1;
                return -1;
            }
            
            if(count($la_dataOut) == 0){
                $la_return['mensaje'] = "Datos incorrectos para iniciar sesión. Código: 001.";
                return -1;
            }
            
            $ls_password_usuario = $la_dataOut[0]->password;     
                   
            if( md5($this->password) != $ls_password_usuario){
                $la_return['mensaje'] = "Datos incorrectos para iniciar sesión. Código: 002.";
                return -1;
            }
            
            $la_infoUsuario = $la_dataOut[0];
            $la_dataSession = [
                'id_usuario'  => $la_infoUsuario->id_usuario,
                'id_perfil_acceso'  => $la_infoUsuario->id_perfil_acceso,
                'titulo_perfil'  => $la_infoUsuario->titulo_perfil,
                'usuario'  => $la_infoUsuario->usuario,
                'id_persona_entidad'  => $la_infoUsuario->id_persona_entidad,
                'nombres'  => $la_infoUsuario->nombres,
                'apellido_paterno'  => $la_infoUsuario->apellido_paterno,
                'apellido_materno'  => $la_infoUsuario->apellido_materno,
                'tipo_persona_entidad'  => $la_infoUsuario->tipo_persona_entidad,
                'tipo_persona_desc'  => $la_infoUsuario->tipo_persona_desc,
                'ruta_foto' => $la_infoUsuario->ruta_foto
            ];
            
            $la_return['login'] = true;
            $this->session->set_userdata($la_dataSession);

            $la_notificacion = [
                "notificacion" => false,
                "mensaje"      => ""
            ];

            $this->session->set_userdata($la_notificacion);

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

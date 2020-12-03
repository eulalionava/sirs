<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminUsuarios extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('Admin_usuarios_model', 'modelAdmin', true);
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
    public function verUsuarios(){        
        $la_dataView = array();

        if($this->modelAdmin->obtnerUsuarios($dataOut, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        $la_dataView['data'] = $dataOut;

        $ls_vistaPanelGeneral = $this->load->view('admin_usuarios/usuarios_view', $la_dataView, true);

        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Micuenta"
        );        
        $this->layoutPanel($la_dataView);
        
    }

    public function nuevoUsuario(){
        try{
            $respuesta = array();
            $respuesta['ok'] = true;
            
            $la_data = array(
                "nombre"    =>$this->input->post('data')['nombre'],
                "ap"        =>$this->input->post('data')['ap'],
                "am"        =>$this->input->post('data')['am'],
                "rfc"       =>$this->input->post('data')['rfc'],
                "correo"    =>$this->input->post('data')['correo'],
                "sexo"      =>$this->input->post('data')['sexo'],
                "tipo"      =>$this->input->post('data')['tipo'],
                "numero"    =>$this->input->post('data')['numero']
            );

            if($this->modelAdmin->guardarUsuarios($la_data,$dataOut,$arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

            $respuesta['mensaje'] = "usuario dado de alta correctamente";
            
        }catch(Exception $exc) {
            $ls_mensaje = '"nuevoUsuario" controller does not work. Exception: ' . $exc->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            return -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
        
        return 1;
    }

    public function borrarUsuario(){
        try{
            $respuesta = array();
            $respuesta['ok'] = true;

            $id_persona = $this->input->post('id_persona');

            if($this->modelAdmin->borrarUsuario($id_persona,$arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

            $respuesta['mensaje'] = "Usuario eliminado correctamente";

            
        }catch(Exception $exc) {
            $ls_mensaje = '"borrarUsuario" controller does not work. Exception: ' . $exc->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            return -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
        
        return 1;
    }

    public function editarUsuario(){
        try{
            $respuesta = array();
            $respuesta['ok'] = true;

            $la_data = array(
                "id_persona"=>$this->input->post('data')['id_persona'],
                "nombre"    =>$this->input->post('data')['nombre'],
                "ap"        =>$this->input->post('data')['ap'],
                "am"        =>$this->input->post('data')['am'],
                "rfc"       =>$this->input->post('data')['rfc'],
                "correo"    =>$this->input->post('data')['correo'],
                "sexo"      =>$this->input->post('data')['sexo'],
                "tipo"      =>$this->input->post('data')['tipo'],
                "numero"    =>$this->input->post('data')['numero']
            );

            if($this->modelAdmin->editarUsuario($la_data,$arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

            
        }catch(Exception $exc) {
            $ls_mensaje = '"editarUsuario" controller does not work. Exception: ' . $exc->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            return -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
        
        return 1;
    }
}

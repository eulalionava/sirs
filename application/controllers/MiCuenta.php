<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MiCuenta extends MY_Controller {    
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
        $ls_vistaPanelGeneral = $this->load->view('candidatos/cuenta_candidato_view', array(), true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Micuenta"
        );        
        $this->layoutPanel($la_dataView);
        
    }
    
    public function guardarRespuestasCuestinario(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
            $ls_mensaje = "";
                      
            $la_respuestas = $this->input->post('data')['respuestas'];
            
            if(count($la_respuestas) == 0){
                $la_return['mensaje'] = "Ocurrió un error inesperado: las repuestas no han sido recibidas.";
                $la_return['return'] = -1;
                return;
            }
            
            $la_respuestasValidadas = array();
            foreach($la_respuestas as $respuesta){
                /*
                 * 1: abierta (textarea)
                 * 2: radios
                 * 3: checkbox
                 */
                $li_id_pregunta = $respuesta["id_pregunta"];
                $ls_respuesta = trim($respuesta["respuesta"], ",");
                $ls_hora_inicia = (strlen(trim($respuesta["hora_inicia"])) > 0)?date("Y-m-d")." ".$respuesta["hora_inicia"]:NULL;
                $ls_hora_fin = (strlen(trim($respuesta["hora_fin"])) > 0)?date("Y-m-d")." ".$respuesta["hora_fin"]:NULL;;
                
                $la_respuestasValidadas[] = array(
                    "id_pregunta" => $li_id_pregunta,
                    "id_usuario" => $this->id_persona_entidad,
                    "respuesta" => $ls_respuesta,
                    "comienza" => $ls_hora_inicia,
                    "termina" => $ls_hora_fin
                );
            }
            
            $la_dataSalida = array();
            if($this->mCandidato->guardarRespuestasCuestionario($la_respuestasValidadas, $la_dataSalida, $ls_mensaje) < 0){
                $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
                $la_return['return'] = -1;
                return;
            }
            
            $la_return['mensaje'] = "El cuestionario seleccionado ha sido completado.";
            
        }catch(Exception $exc) {
            $ls_mensaje = '"finalizarProcesoSolicitud" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function finalizarProcesoSolicitud(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
                
            $la_dataIn = array();            
            
            $data = json_decode(file_get_contents('php://input'),1);
            var_dump($data);
            
        }catch(Exception $exc) {
            $ls_mensaje = '"finalizarProcesoSolicitud" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function cambiarPassword(){
        $la_dataIn = array(
            "id_persona_entidad" => $this->id_persona_entidad
        );
        
        if($this->mCandidato->obtenerEstructuraCompletaCandidato($la_dataIn, $la_dataCandidato, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        
        $la_dataView = array(
        );
        $ls_vistaPanelGeneral = $this->load->view('candidatos/cambiar_password_candidato_view', $la_dataView, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Cambiar contraseña"
        );        
        $this->layoutPanel($la_dataView);
    }
    
    public function datosPersonales(){
        $la_dataIn = array(
            "id_persona_entidad" => $this->id_persona_entidad
        );
        
        if($this->mCandidato->informacionPersonalCandidato($la_dataIn, $la_dataCandidato, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        
        $la_dataView = array(
            "informacion"=>$la_dataCandidato
        );
        
        $ls_vistaPanelGeneral = $this->load->view('candidatos/datos_personales_candidato_view', $la_dataView, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Mis datos personales"
        );        
        
        $this->layoutPanel($la_dataView);
    }

    public function cambiarDatosPersonales(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
                
            $la_dataIn = array(
                "id_persona_entidad" =>$this->id_persona_entidad,
                "nombre"             =>$this->input->post('data')['nombre'],
                "apellido_paterno"   =>$this->input->post('data')['apellido_p'],
                "apellido_materno"   =>$this->input->post('data')['apellido_m'],
                "sexo"               =>$this->input->post('data')['sexo'],
                "rfc"                =>$this->input->post('data')['rfc'],
                "numero"             =>$this->input->post('data')['numero'],
                "correo"             =>$this->input->post('data')['correo'],
            );
            
            if($this->mCandidato->cambiarInformacionPersonal($la_dataIn, $arg_mensaje) < 0){
                echo $arg_mensaje;
            }
            
        }catch(Exception $exc) {
            $ls_mensaje = '"cambiarDatosPersonales" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }

    public function passwordChange(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
                
            $la_data = array(
                "id_persona_entidad" =>$this->id_persona_entidad,
                "anterior"           =>md5($this->input->post('data')['anterior']),
                "nueva"              =>md5($this->input->post('data')['nueva']),
                "repetir"            =>md5($this->input->post('data')['repetir'])
            );

            if($this->mCandidato->informacionPersonalCandidato($la_data, $la_dataCandidato, $arg_mensaje) < 0){
                echo $arg_mensaje;
            }

            if( $la_data['anterior'] != $la_dataCandidato[0]->password){
                $la_return['mensaje'] = "Tu contraseña anterior no coicide";
                $la_return['return'] = -1;
            }

            if( $la_data['nueva'] != $la_data['repetir']){
                $la_return['mensaje'] = "Tu contraseña nueva no coicide";
                $la_return['return'] = -1;
            }
            
            $la_dataIn = array(
                "id_usuario" =>$la_dataCandidato[0]->id_usuario,
                "nueva"              =>md5($this->input->post('data')['nueva']),
            );
            
            if( $la_return['return'] > 0){
                if($this->mCandidato->cambiar_password($la_dataIn, $arg_mensaje) < 0){
                    echo $arg_mensaje;
                }
            }

            
        }catch(Exception $exc) {
            $ls_mensaje = '"cambiarDatosPersonales" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }

}

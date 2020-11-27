<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SolicitudEmpleo extends MY_Controller {    
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
        $ls_vistaPanelGeneral = $this->load->view('candidatos/solicitud_empleado_view', array(), true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Solicitud de empleo"
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
            $id_vacante_cuestionartio = $this->input->post('id_vacante_cuestionario');
            
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

            //Guardar el estatus de cuestionario terminado
            if($this->mCandidato->guardarStatusDeCuestionario($id_vacante_cuestionartio,$dataSalida,$arg_mensaje) < 0){
                $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde";
                $la_return['return'] = -1;
                return;
            }

            $la_return['puntaje_total'] = $la_dataSalida;
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
    
    public function continuarTramite(){
        $la_dataIn = array(
            "id_persona_entidad" => $this->id_persona_entidad
        );
        
        if($this->mCandidato->obtenerEstructuraCompletaCandidato($la_dataIn, $la_dataCandidato, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        
        $li_total_registros = count($la_dataCandidato);
        $la_cuestionarioGeneral = array();
        $la_cuestionarioOrtografia = array();
        $la_cuestionarioTyping = array();
        $la_documentosSolicitar = array();
        
        $ls_ruta_solicitud_empleo = "";
        if($li_total_registros > 0){
            foreach($la_dataCandidato as $dataCandidato){
                if($dataCandidato->id_tipo_cuestionario == 1){
                    $la_cuestionarioOrtografia[] = $dataCandidato;
                }
                
                if($dataCandidato->id_tipo_cuestionario == 2){
                    $la_cuestionarioTyping[] = $dataCandidato;
                }
                
                if($dataCandidato->id_tipo_cuestionario == 3){
                    $la_cuestionarioGeneral[] = $dataCandidato;
                }
            }
            
            $ls_ruta_solicitud_empleo = $la_dataCandidato[0]->solicitud_cliente; 
            
            $la_dataInDocs = array(
                "id_campania" => $la_dataCandidato[0]->id_campania
            );
            
            if($this->mCandidato->obtenerSolicitarDocumentos($la_dataInDocs, $la_documentosSolicitar, $arg_mensaje) < 0){
                echo $arg_mensaje;
            }
        }
        
        $la_dataView = array(
            "cuestionario_general" => $la_cuestionarioGeneral,
            "cuestionario_ortografia" => $la_cuestionarioOrtografia,
            "cuestionario_typing" => $la_cuestionarioTyping,
            "solicitud_cliente" => $ls_ruta_solicitud_empleo,
            "solicitar_documentos" => $la_documentosSolicitar
        );
        $ls_vistaPanelGeneral = $this->load->view('candidatos/continuar_tramite_candidato_view', $la_dataView, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Solicitud de empleo"
        );        
        $this->layoutPanel($la_dataView);
    }    
}

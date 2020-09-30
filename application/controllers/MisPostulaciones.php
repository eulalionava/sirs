<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MisPostulaciones extends MY_Controller {    
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
        $ls_vistaPanelGeneral = $this->load->view('candidatos/postulaciones_candidatos_view', array(), true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Mis postulaciones"
        );        
        $this->layoutPanel($la_dataView);
    }
    
    public function consultarDocumentos(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
            
            $la_infoRequest = $this->input->post('data');
            $li_totalInfoRequest = count($la_infoRequest);
            if($li_totalInfoRequest == 0){
                $la_return['mensaje'] = "No se encontraron documentos para consultar.";
                $la_return['return'] = -1;
                return;
            }
            
            
            $ls_id_cliente = "";
            $ls_id_docs = "";
            foreach($la_infoRequest as $infoRequest){
                $li_id_cliente = $infoRequest["id_cliente"];
                $li_id_documento = $infoRequest["id_documento"];
                if($li_id_cliente > 0){
                    $ls_id_cliente = $li_id_cliente;
                }else{
                    $ls_id_docs .= $li_id_documento.",";
                }
            }
            
            $la_dataIn = array(
                "id_persona_entidad" => $this->id_persona_entidad,
                "id_cliente" => $ls_id_cliente,
                "id_documento" => trim($ls_id_docs, ",")
            );
            
            $la_dataOut = array();
            if($this->mCandidato->consultarDocumentos($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
                $la_return['mensaje'] = $ls_mensaje;
                $la_return['return'] = -1;
                return;
            }

            $la_dataView = array(
                "detalle_documentos" => $la_dataOut
            );

            $ls_detalleVacante = $this->load->view('candidatos/documentos_view', $la_dataView, true);
            $la_return['contenido'] = $ls_detalleVacante;
        }catch(Exception $exc) {
            $ls_mensaje = '"detalleCuestionario" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function cargarDocumentos(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
            $li_tota_archivos = 0;
            
            
            $li_tota_archivos = count($_FILES["file"]["name"]);
            $li_id_cliente = $this->input->post('id_cliente[]');            
            if($li_tota_archivos == 0){
                $la_return['mensaje'] = "No se encontraron archivos para cargar.";
                $la_return['return'] = -1;
                return;
            }
            
            $la_filesSubir = $_FILES;
            var_dump($la_filesSubir);
            $la_return['return'] = -1;
            return;
            $la_idDocumentos = $this->input->post('id_documento');
            $ls_path_archivos = __DIR__.'/../../uploads/candidatos/'.md5($this->id_persona_entidad)."/";
            $ls_subbpath_archivos = __DIR__.'/../../';
            
            if(!file_exists($ls_path_archivos)){
                mkdir($ls_path_archivos, 0777, true);
            }
            
            $la_extensionesPermitidas = array(
                "txt", "doc", "docs", "pdf", "jpg", "jpeg", "png"
            );
            for($li_index = 0; $li_index < $li_tota_archivos; $li_index++){
                $ls_name = $la_filesSubir["file"]["name"][$li_index];
                $ls_tmp_name = $la_filesSubir["file"]["tmp_name"][$li_index];
                $ls_type = $la_filesSubir['file']['type'][$li_index];
                $li_size = $la_filesSubir['file']['size'][$li_index];
                $li_sizeToMb = ($li_size / 1024) / 1024;
                
                if($li_sizeToMb > 4){
                    $la_return['mensaje'] = "El peso del archivo supera el máximo permitido (4 mb): ".$ls_name;
                    $la_return['return'] = -1;
                    return;
                }
                
                $la_extension = explode('.',$la_filesSubir["file"]["name"][$li_index]);
                $ls_extension = strtolower(end($la_extension));
                
                if(!isset($la_extensionesPermitidas[$ls_extension])){
                    $la_return['mensaje'] = "La extensión del archivo no es válida: ".$ls_name;
                    $la_return['return'] = -1;
                    return;
                }
                
                
                
                $ls_full_path_archivo = $ls_path_archivos.$ls_name;
                if(!move_uploaded_file($la_filesSubir["file"]["tmp_name"][$li_index], $ls_full_path_archivo)){
                    $la_return['mensaje'] = "Error al subir archivo: ".$ls_name;
                    $la_return['return'] = -1;
                    return;
                }
                
                $la_dataAlmacenar = array();
                $li_id_documento = $la_idDocumentos[$li_index];
                
                $ls_real_full_path_archivo = str_replace($ls_subbpath_archivos,'',$ls_full_path_archivo);
                if($li_id_cliente > 0){
                    $la_dataAlmacenar = array(
                        "solicitud" => 1,
                        "id_cliente" => $li_id_cliente,
                        "id_persona_entidad" => $this->id_persona_entidad,
                        "solicitud_empleo" => $ls_real_full_path_archivo
                    );
                }else{
                    $la_dataAlmacenar = array(
                        "solicitud" => 0,
                        "id_documento" => $li_id_documento,
                        "id_candidato" => $this->id_persona_entidad,
                        "nombre_archivo" => $ls_name,
                        "ruta_archivo" => $ls_real_full_path_archivo
                    );
                }
                
                $la_dataOut = array();
                if($this->mCandidato->guardarDocumentosCandidato($la_dataAlmacenar, $la_dataOut, $ls_mensaje) < 0){
                    $la_return['mensaje'] = $ls_mensaje;
                    $la_return['return'] = -1;
                    return;
                }                
            }
            
        }catch(Exception $exc) {
            $ls_mensaje = '"cargarDocumentos" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function mostrarDocumentos(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
            
            $la_dataIn = array(
                "id_persona_entidad" => $this->id_persona_entidad,
                "id_vacante_md5" => $this->input->post('data')['hash']
            );
            $la_dataOut = array();
            if($this->mCandidato->obtenerDocumentos($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
                $la_return['mensaje'] = $ls_mensaje;
                $la_return['return'] = -1;
                return;
            }

            $la_dataView = array(
                "detalle_documentos" => $la_dataOut
            );

            $ls_detalleVacante = $this->load->view('candidatos/documentos_view', $la_dataView, true);
            $la_return['contenido'] = $ls_detalleVacante;
        }catch(Exception $exc) {
            $ls_mensaje = '"detalleCuestionario" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function detalleCuestionario(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
            
            $la_dataIn = array(
                "id_persona_entidad" => $this->id_persona_entidad,
                "id_cuestionario_md5" => $this->input->post('data')['hash']
            );
            $la_dataOut = array();
            if($this->mCandidato->obtenerDetalleCuestionario($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
                $la_return['mensaje'] = $ls_mensaje;
                $la_return['return'] = -1;
                return;
            }

            $la_dataView = array(
                "detalle_cuestionario" => $la_dataOut
            );

            $ls_detalleVacante = $this->load->view('candidatos/cuestionario_view', $la_dataView, true);
            $la_return['contenido'] = $ls_detalleVacante;
        }catch(Exception $exc) {
            $ls_mensaje = '"detalleCuestionario" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function cuestionariosVacante(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
            
            $la_dataIn = array(
                "id_usuario" => $this->id_persona_entidad,
                "id_vacante_md5" => $this->input->post('data')['hash']
            );
            $la_dataOut = array();
            if($this->mCandidato->obtenerCuestionariosVacante($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
                $la_return['mensaje'] = $ls_mensaje;
                $la_return['return'] = -1;
                return;
            }

            $la_dataView = array(
                "detalle_vacante" => $la_dataOut
            );

            $ls_detalleVacante = $this->load->view('candidatos/cuestionarios_vacante_view', $la_dataView, true);
            $la_return['contenido'] = $ls_detalleVacante;
        }catch(Exception $exc) {
            $ls_mensaje = '"detalleVacante" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function detalleVacante(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
            
            $la_dataIn = array(
                "id_persona_entidad" => $this->id_persona_entidad,
                "id_vacante_md5" => $this->input->post('data')['hash']
            );
            $la_dataOut = array();
            if($this->mCandidato->obtenerVacantesCandidato($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
                $la_return['mensaje'] = $ls_mensaje;
                $la_return['return'] = -1;
                return;
            }

            $la_dataView = array(
                "detalle_vacante" => $la_dataOut
            );

            $ls_detalleVacante = $this->load->view('candidatos/detalle_vacante_view', $la_dataView, true);
            $la_return['contenido'] = $ls_detalleVacante;
        }catch(Exception $exc) {
            $ls_mensaje = '"detalleVacante" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function vacantesCandidato(){
        $la_dataIn = array(
            "id_persona_entidad" => $this->id_persona_entidad
        );
        $la_dataOut = array();
        if($this->mCandidato->obtenerVacantesCandidato($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
            echo $ls_mensaje;
        }
        
        $la_dataView = array(
            "mis_vacantes" => $la_dataOut
        );
        
        $ls_vistaPanelGeneral = $this->load->view('candidatos/mis_vacantes_candidato_view', $la_dataView, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Mis vacantes"
        );        
        $this->layoutPanel($la_dataView);
    }    
}

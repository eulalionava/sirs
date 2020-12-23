<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'src/Exception.php');
require_once(APPPATH.'src/PHPMailer.php');
require_once(APPPATH.'src/SMTP.php');

class MisPostulaciones extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('InformacionCandidatos_model', 'mCandidato', true);
        $this->load->helper('fecha_espanol');
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
    
    public function guardarEntrevista(){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;

            $fecha = date("Y-m-d");
            $la_dataIn = array(
                "id_entrevista"         => $this->input->post('data')["id_entrevista"],
                "id_persona_entidad"    => $this->id_persona_entidad,
                "fecha"                 => $fecha
            );

            $la_return['ok'] = true;
            $la_dataOut = array();
            if($this->mCandidato->guardarEntrevistaCandidato($la_dataIn,$la_dataOut, $ls_mensaje) < 0){
                $la_return['mensaje']   = $ls_mensaje;
                $la_return['return']    = -1;
                $la_return['ok']        = false;
                return;   
            }
            
            
            
            
        }catch(Exception $exc) {
            $ls_mensaje = '"guardarEntrevista" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }finally{
            header("Content-type: application/json");
            echo json_encode($la_return);
        }
        
        return 1;
    }
    
    public function agendarEntrevista(){

        $la_dataInEntrevista = array(
            "id_persona_entidad" => $this->id_persona_entidad,
            "fecha_entrevista"   => date("Y-m-d")
        );

        //verifica si tiene entrevista pendiente
        if($this->mCandidato->obtenerEntrevistaCandidato($la_dataInEntrevista, $la_dataEntrevista, $ls_mensaje) < 0){
            echo $ls_mensaje;
        }

        if($this->mCandidato->cuestionariosTerminado($la_dataInEntrevista, $cuestionarios, $ls_mensaje) < 0){
            echo $ls_mensaje;
        }


        if(count($la_dataEntrevista) == 0){

            if($this->mCandidato->obtenerHorariosEntrevista($la_dataInEntrevista, $la_dataOut, $ls_mensaje) < 0){
                echo $ls_mensaje;
            }
        }
        
        if(count($cuestionarios) == 0){
            if(count($la_dataOut) == 0){
               $this->enviar_correo("delianavam@gmail.com",'delianavam@gmail.com');
            }
        }

        $la_dataView = array(
            "data_entrevista" => $la_dataEntrevista,
            "data_horarios" => $la_dataOut,
            "cuestionarios_finalizado"=>$cuestionarios
        );

        $ls_vistaPanelGeneral = $this->load->view('candidatos/agendar_entrevista_candidato_view', $la_dataView, true);
        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Agendar entrevista"
        );        
        $this->layoutPanel($la_dataView);
        
    }

    //Funcion para enviar correos
    public function enviar_correo($From,$To){
        $mail=new PHPMailer();
        $mail->CharSet = 'UTF-8';

        $body = 'Cuerpo del correo de prueba';

        $mail->SMTPDebug  = 0;
        $mail->IsSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'delianavam@gmail.com';
        $mail->Password   = '141993.ecn/*';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->SetFrom($From, "Eulalio");
        $mail->AddAddress($To, 'Eulalio');

        $mail->Subject    = 'No hay horarios disponibles';
        $mail->Body = "Un candidato consulto los horarios disponibles, para agendar una entrevista favor de verificar";
        $mail->send();
    }
    
    public function descargarDocumento($params = array()){
        try{
            $la_return = array();
            $la_return['mensaje'] = "";
            $la_return['return'] = 1;
            $ls_params = $params;
            $ls_tipo_archivo = substr($ls_params, -1);
            
            $la_dataIn = array(
                "tipo_archivo" => $ls_tipo_archivo,
                "id_archivo" => trim($ls_params, $ls_tipo_archivo)
            );
            
            $la_dataOut = array();
            if($this->mCandidato->consultarDocumentoDescarga($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
                $la_return['mensaje'] = $ls_mensaje;
                $la_return['return'] = -1;
                return;
            }
            
            $ls_ruta_real = "../../".$la_dataOut[0]->ruta_archivo;
            $ls_nombreArchivo = basename($ls_ruta_real);
            
            
            $fullPath = base_url().$la_dataOut[0]->ruta_archivo;
            if($fullPath) {
                $fsize = filesize($fullPath);
                $path_parts = pathinfo($fullPath);
                $ext = strtolower($path_parts["extension"]);

                switch ($ext) {
                    case "pdf":
                        header("Content-Disposition: attachment; filename=\"" . $path_parts["basename"]."\""); // Use 'attachment' to force a download
                        header("Content-type: octet/stream"); // Add here more headers for diff. extensions
                        break;
                    default;
                        header("Content-type: application/octet-stream");
                        header("Content-Disposition: filename=\"" . $path_parts["basename"]."\"");
                }

                if($fsize) { // Checking if file size exist
                    header("Content-length: $fsize");
                }
                readfile($fullPath);
                exit;
            }
        }catch(Exception $exc) {
            $ls_mensaje = '"detalleCuestionario" controller does not work. Exception: ' . $exc->getTraceAsString();
            $la_return['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$ls_mensaje;
            $la_return['return'] = -1;
        }        
        
        return 1;
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
            $la_return['info_docs'] = $la_dataOut;
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
            
            $la_idDocumentos = $this->input->post('id_documento');
            $ls_path_archivos = __DIR__.'/../../uploads/candidatos/'.md5($this->id_persona_entidad)."/";
            $ls_subbpath_archivos = __DIR__.'/../../';
            
            if(!file_exists($ls_path_archivos)){
                mkdir($ls_path_archivos, 0777, true);
            }
            
            $la_extensionesPermitidas = array(
                "txt" => 1, "doc" => 1, "docx" => 1, "pdf" => 1, "jpg" => 1, "jpeg" => 1, "png" => 1
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
                    $la_return['mensaje'] = "La extensión del archivo no es válida: ".$la_extensionesPermitidas[$ls_extension];
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
            $documentos_cargados = [];
            if($this->mCandidato->getDocumentosCargadosCandidato($la_dataIn, $la_dataDocs, $ls_mensaje) < 0){
                $la_return['mensaje'] = $ls_mensaje;
                $la_return['return'] = -1;
                return;
            }

            if(count($la_dataDocs) > 0){
                foreach($la_dataDocs as $docs){
                    $documentos_cargados[$docs->id_documento]  = array("archivo"=>$docs->nombre_archivo,"ruta"=>$docs->ruta_archivo);
                }
            }



            $la_dataView = array(
                "detalle_documentos" => $la_dataOut,
                "documentos_cargados" => $documentos_cargados
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
                "id_persona_entidad"    => $this->id_persona_entidad,
                "id_cuestionario_md5"   => $this->input->post('data')['hash'],
                "id_vacante"            => $this->input->post('data')['id_vacante']
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
                "id_vacante_md5" => $this->input->post('data')['hash'],
                "id_vacante" => $this->input->post('data')['id_vacante']
            );

            $la_dataOut = array();
            if($this->mCandidato->obtenerCuestionariosVacante($la_dataIn, $la_dataOut, $ls_mensaje) < 0){
                $la_return['mensaje'] = $ls_mensaje;
                $la_return['return'] = -1;
                return;
            }

            $cuestionarios = [];

            if(count($la_dataOut) > 0){

                foreach($la_dataOut as $cuestionario){

                    if($this->mCandidato->getRespuestasCandidatoVacante($cuestionario->id_cuestionario,$la_dataIn, $la_dataResp, $ls_mensaje) < 0){
                        $la_return['mensaje'] = $ls_mensaje;
                        $la_return['return'] = -1;
                        return;
                    }
                    
                    if(count($la_dataResp) > 0){

                        $totalPreguntas = 0;
                        $total          = 0;
    
                        foreach($la_dataResp as $respuesta){
                            $totalPreguntas+= 1;
                            $total+= $respuesta->valor;
                        }

                        $cuestionarios[$cuestionario->id_cuestionario] = array("totalpreguntas"=>$totalPreguntas,"total"=>$total);

                    }


                }
            }

            $la_dataView = array(

                "detalle_vacante" => $la_dataOut,
                "cuestionarios"   => $cuestionarios

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
    
    /**
     * notificacionEntrevistas
     * Funcion que verifica si hay horarios de entrevistas
     */
    public function notificacionEntrevistas(){
        try{
            $fecha = date('Y-m-d');
            $respuesta = array();
            $respuesta['ok'] = true;
            if($this->mCandidato->getEntrevistaHorarios($fecha,$dataOut,$ls_mensaje) < 0){
                $respuesta['ok'] = false;
            }
            
            if( count($dataOut) == 0){
                $respuesta['ok'] =  false;
                $respuesta['tipopersona'] = $this->tipo_persona_entidad;
                $respuesta['mensaje'] = "Hacen falta horarios para entrevista";
            }
            
        }catch(Exception $exc) {

            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }


    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos extends MY_Controller {    
    public function __construct(){
        parent::__construct();
        $this->load->model('Catalogos_model', 'modelCatalogo', true);
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
    public function verVacantes(){        
        $la_dataView = array();

        if($this->modelCatalogo->obtnerVacantes($dataOut, $arg_mensaje) < 0){
            echo $arg_mensaje;
        }
        $la_dataView['vacantes'] = $dataOut;

        $ls_vistaPanelGeneral = $this->load->view('vacantes/vacantes_view', $la_dataView, true);

        $la_dataView = array(
            "view" => $ls_vistaPanelGeneral,
            "title" => "Vacantes"
        );        
        $this->layoutPanel($la_dataView);
        
    }

    /**
     * vacante
     * Vista para la alta de una nueva vacante
     */
    public function vacante(){

        try{

            $respuesta = array();
            $respuesta['ok'] = true;
    
            if($this->modelCatalogo->getCampañas($dataOut, $arg_mensaje) < 0){
                echo $arg_mensaje;
            }
    
            $respuesta['campañas'] = $dataOut;
    
            $ls_view = $this->load->view('vacantes/vacante_view', $respuesta, true);
            $respuesta['contenido'] = $ls_view;

        }catch(Exception $e){
            $arg_mensaje = '"entrevistaDetalle" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }
    /**
     * nuevaVacante
     * Registro de una nueva vacante
     */
    public function nuevaVacante(){
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $la_dataView = array(
                'campana'       =>$this->input->post('data')['campana'],
                'vacante'       =>$this->input->post('data')['vacante'],
                'descripcion'   =>$this->input->post('data')['descripcion'],
                'salario'       =>$this->input->post('data')['salario'],
                'estatus'       =>$this->input->post('data')['estatus']
            );

            $respuesta['data'] = $la_dataView;
    
            if($this->modelCatalogo->nuevaVacante($la_dataView, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

        }catch(Exception $e){
            $arg_mensaje = '"nuevaVacante" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }
    /**
     * eliminarVacante
     * Dar de baja el registro de una vacante
     */
    public function eliminarVacante(){
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $id_vacante = $this->input->post('vacante');
    
            if($this->modelCatalogo->borrarVacante($id_vacante, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

        }catch(Exception $e){
            $arg_mensaje = '"nuevaVacante" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    /**
     * editarVacante
     * Registro de cambios de una vacante
     */

    public function editarVacante(){
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $la_data = array(
                "id_vacante"    => $this->input->post('data')['id_vacante'],
                "vacante"       => $this->input->post('data')['vacante'],
                "descripcion"   => $this->input->post('data')['descrip'],
                "salario"       => $this->input->post('data')['salario'],
                
            );
    
            if($this->modelCatalogo->edicionVacante($la_data, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

        }catch(Exception $e){
            $arg_mensaje = '"editarVacante" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }
    /**
     * asignarViewVacante
     * Vista para la asignacion de candidato,cuestionarios, documentos para cada vacante 
     */
    public function asignarViewVacante(){
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $respuesta['id_vacante']    = $this->input->post('data')['id_vacante'];
            $respuesta['vacante']       = $this->input->post('data')['vacante'];

            if($this->modelCatalogo->getClientes($la_data, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }
            $respuesta['clientes'] = $la_data;

            $ls_view = $this->load->view('vacantes/asignarCuestionarios_view', $respuesta, true);
            $respuesta['contenido'] = $ls_view;

        }catch(Exception $e){
            $arg_mensaje = '"entrevistaDetalle" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    /**
     * asignarViewVacante
     * Obtener todos los tipos de documentos con filtro de (CLIENTE) 
     */
    public function obtenerCuestionarios(){
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $id_cliente       = $this->input->post('cliente');

            if($this->modelCatalogo->getCuestionarios($id_cliente,$la_data, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

            $respuesta['cuestionarios'] = $la_data;

        }catch(Exception $e){
            $arg_mensaje = '"obtenerCuestionarios" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    }

    /**
     * guardarCuestionarios
     * Guarda los cuestionarios asignados a la vacante
     */
    public function guardarCuestionarios(){
        try{

            $respuesta = array();
            $respuesta['ok'] = true;

            $la_data = array(
                "id_cuestionario" => $this->input->post('data')['id_cuestionario'],
                "id_vacante"=>$this->input->post('data')['id_vacante']
            );

            if($this->modelCatalogo->getvacanteCuestionario($la_data,$la_dataOut, $arg_mensaje) < 0){
                $respuesta['ok'] = false;
            }

            $respuesta['total'] = count($la_dataOut);
            if( count($la_dataOut) == 0){

                if($this->modelCatalogo->guardarCuestionarios($la_data, $arg_mensaje) < 0){
                    $respuesta['ok'] = false;
                }

            }


        }catch(Exception $e){
            $arg_mensaje = '"guardarCuestionarios" controller does not work. Exception: ' . $e->getTraceAsString();
            $respuesta['mensaje'] = "Ocurrió un error inesperado, inténtelo más tarde: ".$arg_mensaje;
            $respuesta['ok'] = false;

        }finally{
            header("Content-type: application/json");
            echo json_encode($respuesta);
        }
    } 
   
}

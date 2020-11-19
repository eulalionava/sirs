<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seleccionador_model extends CI_Model {    
    
    public function __construct() {
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

     /**
      * getEntrevistas
      * Obtener las entrevistas por seleccionador
      */
    public function getEntrevistas($datos,&$arg_data,&$arg_mensaje){

        try {
            $ls_query = "SELECT * FROM entrevista 
                        WHERE id_usuario_entrevistador = '".$datos['id_persona_entidad']."'
                        AND fecha_entrevista >= '".$datos['fecha_actual']."'
                        ORDER BY fecha_entrevista,hora_entrevista ;";  
                                  
            $statement = $this->db->query($ls_query);
            $arg_mensaje = $ls_query;

            if ($statement) {
                $arg_data = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'getEntrevistas method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;
    }

    public function getEntrevistaDetalle($id,&$arg_data,&$arg_mensaje){
        try {
            $ls_query = "SELECT 
                        e.id_entrevista,
                        e.id_persona_entidad,
                        e.fecha_entrevista,
                        e.hora_entrevista,
                        e.descripcion_entrevista,
                        pe.nombres,
                        pe.apellido_paterno,
                        pe.apellido_materno,
                        pe.rfc,
                        pe.correo_electronico,
                        pe.ruta_foto
                        FROM entrevista e 
                        INNER JOIN personas_entidades pe 
                            ON e.id_persona_entidad = pe.id_persona_entidad
                        WHERE e.id_entrevista = '".$id."' ;";  
                                  
            $statement = $this->db->query($ls_query);

            if ($statement) {
                $arg_data = $statement->result();
            } else {
                return -1;
            }
        } catch (Exception $exc) {
            $arg_mensaje = 'getEntrevistaDetalle method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }

        return 1;
    }

    public function addEntrevistaComentario($datos){
        try{

            $la_update = Array(
                "descripcion_entrevista"=>$datos['comentario']
            );
            $la_where = Array(
                "id_entrevista"=>$datos['id_entrevista']
            );

            $this->db->update("entrevista",$la_update,$la_where);

        }catch(Exception $e){

        }
    }
    
}
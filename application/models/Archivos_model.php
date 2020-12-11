<?php

class Archivos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * obtnerVacantes
     * Se obtienen todo el registro de vacantes 
     */
    public function obtnerTipoArchivos(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                            id_tipo_archivo,
                            tipo_archivo
                        FROM tipo_archivo ";

            $statement = $this->db->query($ls_query);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getCuestionarios method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }  
    
    public function m_nuevotipoArchivo($tipo, &$arg_mensaje) {
        try {
            $ls_data = array(
                "tipo_archivo"=>$tipo
            );

           $this->db->insert("tipo_archivo",$ls_data);


        } catch (Exception $exc) {
            $arg_mensaje = 'm_nuevotipoArchivo method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }   

    /**
     * nuevoDocumento
     * Alta de un nuevo documento 
     */

}

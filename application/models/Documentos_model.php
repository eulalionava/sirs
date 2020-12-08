<?php

class Documentos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * obtnerVacantes
     * Se obtienen todo el registro de vacantes 
     */
    public function getDocs(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                            id,
                            nombre_doc,
                            descripcion,
                            idsesion
                        FROM catalogo_docs_expediente ";

            $statement = $this->db->query($ls_query);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'obtenerDocs method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }    

    /**
     * nuevoDocumento
     * Alta de un nuevo documento 
     */
    public function nuevoDocumento($dataIn, &$arg_mensaje){
        try {
            $la_data = array(
                "nombre_doc"    =>$dataIn['documento'],
                "descripcion"   =>$dataIn['descripcion'],
                "idsesion"      =>$this->id_persona_entidad
            );

            $this->db->insert("catalogo_docs_expediente",$la_data);

        } catch (Exception $exc) {
            $arg_mensaje = 'nuevoDocumento method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

}

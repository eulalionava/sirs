<?php

class DocumentosCampana_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * getCampanasModel
     * Se obtienen todas las campañas
     */
    public function getCampanasModel(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                                campana.id_campana,
                                clientes.id_cliente,
                                campana.campana,
                                campana.descripcion_campana,
                                clientes.nombre,
                                clientes.descripcion_cliente,
                                clientes.rfc,
                                clientes.solicitud,
                                clientes.logo
                        FROM campana 
                            INNER JOIN clientes 
                                ON campana.id_campana=clientes.id_cliente; ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getCampanasModel method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }    


    public function getClientesModel(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                                clientes.id_cliente,
                                clientes.nombre,
                                clientes.descripcion_cliente,
                                clientes.rfc,
                                clientes.solicitud,
                                clientes.logo,
                                clientes.id_estatus
                        FROM clientes ";

            $statement = $this->db->query($ls_query);

            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getClientesModel method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }    

    public function nuevoCampana($arg_dataIn, &$arg_mensaje) {
        try {
            $ls_data = array(
                "id_cliente"            =>intval($arg_dataIn['cliente']),
                "campana"               =>$arg_dataIn['campana'],
                "descripcion_campana"   =>$arg_dataIn['descripcion']
            ); 

            $this->db->insert("campana",$ls_data);

        } catch (Exception $exc) {
            $arg_mensaje = 'nuevoCampana method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }    

}

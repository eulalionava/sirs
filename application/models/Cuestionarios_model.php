<?php

class Cuestionarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * obtnerVacantes
     * Se obtienen todo el registro de vacantes 
     */
    public function getCuestionarios(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                            id_cuestionario,
                            titulo_cuestionario,
                            cuestionarios.descripcion_cuestionario,
                            intentos,
                            cuestionarios.id_tipo_cuestionario,
                            clientes.id_cliente,
                            clientes.nombre,
                            clientes.descripcion_cliente,
                            tipo_cuestionario.tipo_cuestionario
                        FROM cuestionarios 
                        INNER JOIN clientes 
                            ON cuestionarios.id_cliente = clientes.id_cliente
                        INNER JOIN tipo_cuestionario 
                            ON cuestionarios.id_tipo_cuestionario=tipo_cuestionario.id_tipo_cuestionario
                        WHERE cuestionarios.estatus = 1; ";

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

    /**
     * editaCuestionario
     * Editar cuestionario
     */
    public function editaCuestionario($dataIn, &$arg_mensaje){
        try {
            $la_update = array(
                "titulo_cuestionario"           =>$dataIn['cuestionario'],
                "descripcion_cuestionario"      =>$dataIn['descripcion'],
                "intentos"                      =>$dataIn['intentos'],
                "fecha_modifica"                =>date("Y-m-d H:i:s"),
                "id_usuario_modifica"           =>$this->id_persona_entidad,
            );
            $la_where = array(
                "id_cuestionario" => $dataIn['id_cuestionario']
            );

            $this->db->update("cuestionarios",$la_update,$la_where);

        } catch (Exception $exc) {
            $arg_mensaje = 'editaCuestionario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    /**
     * getClientes
     * Obtiene todos los registros de clientes
     */
    public function getClientes(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                            id_cliente,
                            nombre,
                            descripcion_cliente,
                            rfc,
                            solicitud,
                            logo,
                            id_estatus
                        FROM clientes ";

            $statement = $this->db->query($ls_query);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getClientes method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }  
    
     /**
     * getClientes
     * Obtiene todos los registros de tipos de cuestionario
     */
    public function getTipoCuestionario(&$arg_dataOut, &$arg_mensaje) {
        try {
            $ls_query = "SELECT 
                            id_tipo_cuestionario,
                            tipo_cuestionario,
                            descripcion_cuestionario
                        FROM tipo_cuestionario ";

            $statement = $this->db->query($ls_query);
            if ($statement) {
                $arg_dataOut = $statement->result();
            } else {
                return -1;
            }

        } catch (Exception $exc) {
            $arg_mensaje = 'getTipoCuestionario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    } 

    /**
     * newCuestionario
     * Alta nuevo cuestionario
     */
    public function newCuestionario($dataIn, &$arg_mensaje){
        try {
            $la_data = array(
                "id_cliente"                =>intval($dataIn['cliente']),
                "titulo_cuestionario"       =>$dataIn['cuestionario'],
                "descripcion_cuestionario"  =>$dataIn['descripcion'],
                "intentos"                  =>intval($dataIn['intentos']),
                "estatus"                   =>1,
                "id_tipo_cuestionario"      =>intval($dataIn['tipo']),
                "fecha_alta"                =>date("Y-m-d H:i:s"),
                "id_usuario_alta"           =>$this->id_persona_entidad,
            );

            $this->db->insert("cuestionarios",$la_data);

        } catch (Exception $exc) {
            $arg_mensaje = 'newCuestionario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

    
    public function borrarCuestionario($id_cuestionario, &$arg_mensaje){
        try {
            $la_update = array(
                "estatus"   => 2
            );

            $la_where = array(
                "id_cuestionario" => $id_cuestionario
            );

            $this->db->update("cuestionarios",$la_update,$la_where);

        } catch (Exception $exc) {
            $arg_mensaje = 'borrarCuestionario method does not work. Exception: ' . $exc->getTraceAsString();
            return -1;
        }
        
        return 1;
    }

}
